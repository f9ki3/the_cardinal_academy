<?php
include 'session_login.php';
include '../db_connection.php';

$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$grade_level  = isset($_GET['grade']) ? $_GET['grade'] : '';

$tuition_fee   = 0.00;
$miscellaneous = 0.00;
$total         = 0.00;

$scheme_text = ''; // JSON string from TEXT column

// Detect Grade 11/12 (Senior High) for monthly divisor = 4
$isSeniorHigh = false;
if (!empty($grade_level)) {
  // Extract number from "Grade 11", "11", etc.
  if (preg_match('/(\d+)/', $grade_level, $m)) {
    $num = intval($m[1]);
    if ($num >= 11) $isSeniorHigh = true;
  }
  // Nursery/Kinder -> not senior
}

if (!empty($grade_level)) {
  $query = "SELECT tuition_fee, miscellaneous, `scheme`
            FROM tuition_fees
            WHERE grade_level = ?
            LIMIT 1";

  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $grade_level);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $tuition_fee   = (float)$row['tuition_fee'];
    $miscellaneous = (float)$row['miscellaneous'];
    $scheme_text   = (string)$row['scheme'];
    $total         = $tuition_fee + $miscellaneous;
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
      <form action="enroll_form.php" method="POST">
        <div class="bg-white p-4 rounded-4">
          <fieldset>
            <h4><strong>Transaction Details</strong></h4>

            <!-- ✅ Grade Level for JS rules -->
            <input type="hidden" id="grade_level" value="<?= htmlspecialchars($grade_level) ?>">

            <!-- ✅ Scheme JSON (use textarea to preserve JSON safely) -->
            <textarea id="scheme" hidden><?php echo htmlspecialchars(trim($scheme_text)); ?></textarea>

            <!-- ✅ For submission -->
            <input type="hidden" name="payment_total" id="payment_total_value" value="0">
            <input type="hidden" name="installment_count" id="installment_count_value" value="0">
            <input type="hidden" name="installment_amount" id="installment_amount_value" value="0">

            <div class="row g-3">
              <input type="hidden" name="id" value="<?= htmlspecialchars($admission_id) ?>">
              <input type="hidden" name="tuition_fee" value="<?= htmlspecialchars($tuition_fee) ?>">
              <input type="hidden" name="miscellaneous" value="<?= htmlspecialchars($miscellaneous) ?>">

              <div class="col-md-6">
                <label class="form-label text-muted">Select Payment Plan</label>
                <select name="payment_plan" id="payment_plan" class="form-control" required>
                  <option value="">-- Select Payment Plan --</option>
                  <option value="Annual">Annual (1 Year)</option>
                  <option value="Semestral">Semestral (2 Semesters)</option>

                  <?php if (!$isSeniorHigh): ?>
                    <option value="Quarterly">Quarterly (4 Quarters)</option>
                    <option value="Monthly">Monthly (9 Months)</option>
                  <?php else: ?>
                    <option value="Monthly">Monthly (4 Months)</option>
                  <?php endif; ?>
                </select>
              </div>

              <div class="col-md-6">
                <label for="enrolled_section" class="form-label text-muted">Enrolled Section</label>
                <select id="enrolled_section" name="enrolled_section" class="form-select" required>
                  <option value="">-- Select Section --</option>
                  <?php
                    $currentYear = date("Y");
                    $nextYear = $currentYear + 1;
                    $currentSchoolYear = $currentYear . "-" . $nextYear;

                    $sql = "SELECT section_id, section_name, grade_level, room, strand, capacity, enrolled, school_year
                            FROM sections
                            WHERE grade_level = '$grade_level'
                            AND school_year = '$currentSchoolYear'
                            ORDER BY grade_level, section_name";

                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                      $hasAvailable = false;
                      while ($row = mysqli_fetch_assoc($result)) {
                        $sectionId   = $row['section_id'];
                        $sectionName = $row['section_name'];
                        $gradeLevel  = $row['grade_level'];
                        $room        = $row['room'];
                        $strand      = $row['strand'];
                        $capacity    = $row['capacity'];
                        $enrolled    = $row['enrolled'];
                        $schoolYear  = $row['school_year'];

                        if ($capacity == $enrolled) continue;

                        $label = "{$sectionName} ( {$gradeLevel}";
                        if (!empty($room)) $label .= ", Room {$room}";
                        if (($gradeLevel == "11" || $gradeLevel == "12") && !empty($strand)) $label .= ", Strand: {$strand}";
                        $label .= ") - {$enrolled}/{$capacity} students";

                        echo "<option value='{$sectionId}'>{$label} [SY: {$schoolYear}]</option>";
                        $hasAvailable = true;
                      }
                      if (!$hasAvailable) echo "<option value='' disabled selected>-- All sections are full --</option>";
                    } else {
                      echo "<option value='' disabled selected>-- No available section --</option>";
                    }
                  ?>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Registration Fee</label>
                <input type="text" name="downpayment" class="form-control" value="₱2,500.00" readonly>
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Tuition Fee</label>
                <input type="text" id="tuition_fee" class="form-control" value="₱<?= number_format($tuition_fee, 2) ?>" readonly>
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Miscellaneous</label>
                <input type="text" id="miscellaneous" class="form-control" value="₱<?= number_format($miscellaneous, 2) ?>" readonly>
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Uniform</label>
                <input type="text" id="uniform" name="uniform" class="form-control" readonly>
              </div>

              <div class="col-md-3">
                <label for="program_type" class="form-label text-muted">Discount Category*</label>
                <select id="program_type" name="program_type" class="form-select" required>
                  <option value="">Select program...</option>
                  <option value="ESC Voucher">ESC Voucher</option>
                  <option value="Loyalty Voucher">Loyalty Voucher</option>
                  <option value="Prime English">Prime English</option>
                  <option value="Prime Mathematics">Prime Mathematics</option>
                  <option value="Others or Special Cases">Others</option>
                </select>
                <div class="invalid-feedback">Please select a program type.</div>
              </div>

              <div class="col-md-2">
                <label class="form-label text-muted">Discount Type</label>
                <select name="discount_type" id="discount_type" class="form-control">
                  <option value="">None</option>
                  <option value="percent">Percent (%)</option>
                  <option value="fixed">Fixed Amount (₱)</option>
                </select>
              </div>

              <div class="col-md-2">
                <label class="form-label text-muted">Discount Value</label>
                <input type="number" name="discount_value" disabled id="discount_value" class="form-control" value="0" min="0" step="0.01">
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Discount Amount (Tuition Fee)</label>
                <input type="text" name="discount_amount" id="discount_amount" readonly class="form-control" value="₱0.00">
              </div>

              <div class="col-md-2">
                <label class="form-label text-muted">Downpayment</label>
                <input type="number" name="down" id="down" class="form-control" value="0" min="0" step="0.01">
              </div>

              <?php
              $sql_uniforms = "SELECT id, grade_level, gender, classification, type, size, price
                              FROM uniforms
                              ORDER BY grade_level, classification, type";
              $result_uniforms = mysqli_query($conn, $sql_uniforms);
              ?>

              <div class="col-md-6">
                <div class="border mt-3 rounded-4 p-3 bg-white" id="payment_breakdown">
                  <h6 class="fw-bold mb-3 fw-bold">Transaction Summary</h6>

                  <ul class="list-group list-unstyled list-group-flush">
                    <li class="list-group-items-iii p-2 bg-light text-muted fw-bold">Fees & Discounts</li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Tuition Fee</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Miscellaneous</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Discount</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2 border-top">
                      <span class="fw-bold">Tuition + Misc - Discount</span>
                      <span class="fw-bold">₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2 border-top">
                      <span class="fw-bold">Payment Total</span>
                      <span class="fw-bold" id="payment_total_display">₱0</span>
                    </li>

                    <!-- ✅ NEW: Breakdown display -->
                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Breakdown</span>
                      <span class="fw-bold" id="breakdown_summary">—</span>
                    </li>
                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted" id="breakdown_label">Installment</span>
                      <span class="fw-bold" id="breakdown_amount">₱0</span>
                    </li>

                    <li class="list-group-items-iii p-0"><hr class="my-2"></li>

                    <li class="list-group-items-iii p-2 bg-light text-muted fw-bold">Initial Payments</li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Registration Fee</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Uniform</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2">
                      <span class="text-muted">Downpayment</span>
                      <span>₱0</span>
                    </li>

                    <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2 mt-2 border-top">
                      <span class="fw-bold">Amount to Pay Today</span>
                      <span class="fw-bold">₱0</span>
                    </li>
                  </ul>

                  <div class="form-check ms-3 mt-3">
                    <input class="form-check-input" type="checkbox" id="reviewed-check">
                    <label class="form-check-label text-muted" for="reviewed-check">
                      I confirm that all data has been reviewed
                    </label>
                  </div>

                  <div class="row">
                    <div class="col-12 col-md-6">
                      <button id="enroll-btn" type="submit" name="action" value="enroll"
                              class="btn btn-danger text-light rounded-4 mt-3 w-100" disabled>
                        <span class="btn-text">Enroll</span>
                        <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                      </button>
                    </div>

                    <script>
                      document.addEventListener("DOMContentLoaded", function() {
                        const reviewedCheck = document.getElementById("reviewed-check");
                        const enrollBtn = document.getElementById("enroll-btn");
                        reviewedCheck.addEventListener("change", function() {
                          enrollBtn.disabled = !this.checked;
                        });
                      });
                    </script>

                    <div class="col-12 col-md-6">
                      <a href="view_enrollment.php?id=<?php echo htmlspecialchars($admission_id)?>"
                         class="btn btn-outline-danger text-danger border-2 rounded-4 mt-3 w-100">Back</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ✅ UNIFORM SIDE (unchanged) -->
              <div class="col-md-6">
                <div class="border mt-3 rounded-4 p-3">
                  <h6 class="mb-3 fw-bold">Uniform Details</h6>

                  <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                      <label class="form-label text-muted small mb-1">Uniform</label>
                      <select class="form-select form-select-sm" id="uniformName">
                        <option value="">-- Select Uniform --</option>
                        <?php while ($row = mysqli_fetch_assoc($result_uniforms)) : ?>
                          <option
                            value="<?= $row['id'] ?>"
                            data-name="<?= htmlspecialchars($row['grade_level'] . ' - ' . $row['classification'] . ' - . ' . $row['type']) ?>"
                            data-size="<?= htmlspecialchars($row['size']) ?>"
                            data-gender="<?= htmlspecialchars($row['gender']) ?>"
                            data-price="<?= $row['price'] ?>"
                          >
                            <?= htmlspecialchars($row['grade_level']) ?> -
                            <?= htmlspecialchars($row['classification']) ?> -
                            <?= htmlspecialchars($row['type']) ?>
                            (<?= htmlspecialchars($row['gender']) ?>, Size: <?= htmlspecialchars($row['size']) ?>)
                            - ₱<?= number_format($row['price'], 2) ?>
                          </option>
                        <?php endwhile; ?>
                      </select>
                    </div>

                    <div class="col-md-2">
                      <label class="form-label text-muted small mb-1">Qty</label>
                      <input type="number" class="form-control form-control-sm" id="uniformQty" min="1" value="1">
                    </div>

                    <div class="col-md-3">
                      <label class="form-label text-muted small mb-1">Price</label>
                      <input type="text" class="form-control form-control-sm" id="uniformPrice" readonly>
                    </div>

                    <div class="col-md-2 d-grid">
                      <button type="button" class="btn border btn-sm" id="addUniformBtn">+ Add</button>
                    </div>
                  </div>

                  <ul class="list-group list-group-flush mt-3 p-0" id="uniformList"></ul>

                  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

                  <script>
                    function calculateUniformTotal() {
                      let total = 0;
                      document.querySelectorAll("#uniformList .item-total").forEach(item => {
                        let value = parseFloat(item.textContent.replace("₱", "").replace(/,/g, "")) || 0;
                        total += value;
                      });
                      document.getElementById("uniform").value = "₱" + total.toFixed(2);
                      window.updateSummary();
                    }

                    function updateUniformCartText() {
                      let cartTextarea = document.getElementById("uniform_cart");
                      let cart = [];

                      document.querySelectorAll("#uniformList li").forEach(li => {
                        let name = li.querySelector("strong").textContent;
                        let qty = parseInt(li.querySelector(".item-qty").textContent.replace("x", "")) || 0;
                        let total = parseFloat(li.querySelector(".item-total").textContent.replace("₱", "").replace(/,/g, "")) || 0;
                        let details = li.querySelector("small").textContent;

                        let genderMatch = details.match(/(Male|Female|Unisex)/);
                        let sizeMatch = details.match(/Size:\s*(\w+)/);

                        cart.push({
                          name,
                          quantity: qty,
                          total,
                          gender: genderMatch ? genderMatch[1] : "",
                          size: sizeMatch ? sizeMatch[1] : ""
                        });
                      });

                      cartTextarea.value = JSON.stringify(cart, null, 2);
                    }

                    document.getElementById("uniformName").addEventListener("change", function() {
                      let price = this.options[this.selectedIndex].getAttribute("data-price");
                      document.getElementById("uniformPrice").value = price ? "₱" + parseFloat(price).toFixed(2) : "";
                    });

                    document.getElementById("addUniformBtn").addEventListener("click", function() {
                      let select = document.getElementById("uniformName");
                      let qty = parseInt(document.getElementById("uniformQty").value) || 0;
                      let price = select.options[select.selectedIndex]?.getAttribute("data-price");
                      let name = select.options[select.selectedIndex]?.getAttribute("data-name");
                      let gender = select.options[select.selectedIndex]?.getAttribute("data-gender");
                      let size = select.options[select.selectedIndex]?.getAttribute("data-size");
                      let id = select.value;

                      if (!id || !price || qty < 1) {
                        alert("Please select a uniform and quantity.");
                        return;
                      }

                      let total = qty * parseFloat(price);
                      let uniformList = document.getElementById("uniformList");
                      let existing = uniformList.querySelector(`li[data-id="${id}"]`);

                      if (existing) {
                        let qtySpan = existing.querySelector(".item-qty");
                        let totalSpan = existing.querySelector(".item-total");

                        let currentQty = parseInt(qtySpan.textContent.replace("x", "")) || 0;
                        let newQty = currentQty + qty;

                        qtySpan.textContent = "x" + newQty;
                        totalSpan.textContent = "₱" + (newQty * parseFloat(price)).toFixed(2);
                      } else {
                        let li = document.createElement("li");
                        li.className = "list-group-items-iii d-flex justify-content-between align-items-center p-2";
                        li.setAttribute("data-id", id);
                        li.innerHTML = `
                          <div>
                            <strong>${name}</strong> <span class="text-muted item-qty">x${qty}</span><br>
                            <small class="text-muted">₱${parseFloat(price).toFixed(2)} each | ${gender}, Size: ${size}</small>
                          </div>
                          <div class="d-flex align-items-center">
                            <span class="fw-bold item-total me-3">₱${total.toFixed(2)}</span>
                            <button type="button" class="btn btn-sm btn-delete">
                              <i class="bi bi-trash"></i>
                            </button>
                          </div>
                        `;
                        uniformList.appendChild(li);

                        li.querySelector(".btn-delete").addEventListener("click", function() {
                          li.remove();
                          calculateUniformTotal();
                          updateUniformCartText();
                        });
                      }

                      calculateUniformTotal();
                      updateUniformCartText();
                      document.getElementById("uniformQty").value = 1;
                    });
                  </script>
                </div>
              </div>

              <div class="col-md-12">
                <textarea id="uniform_cart" class="w-100" hidden name="uniform_cart"></textarea>
              </div>
            </div>
          </fieldset>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<!-- ✅ ONE unified script: discount + summary + payment total + breakdown -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const gradeLevelEl  = document.getElementById("grade_level");
  const schemeEl      = document.getElementById("scheme");

  const planSelect    = document.getElementById("payment_plan");

  const regFeeInput   = document.querySelector("input[name='downpayment']");
  const tuitionInput  = document.getElementById("tuition_fee");
  const miscInput     = document.getElementById("miscellaneous");
  const uniformInput  = document.getElementById("uniform");

  const discountType  = document.getElementById("discount_type");
  const discountValue = document.getElementById("discount_value");
  const discountAmt   = document.getElementById("discount_amount");

  const downInput     = document.getElementById("down");

  const paymentTotalDisplay = document.getElementById("payment_total_display");
  const paymentTotalHidden  = document.getElementById("payment_total_value");

  const breakdownSummaryEl = document.getElementById("breakdown_summary");
  const breakdownLabelEl   = document.getElementById("breakdown_label");
  const breakdownAmountEl  = document.getElementById("breakdown_amount");

  const installmentCountHidden  = document.getElementById("installment_count_value");
  const installmentAmountHidden = document.getElementById("installment_amount_value");

  const summaryLis = document.querySelectorAll(".list-group-items-iii");

  function parsePeso(value) {
    return parseFloat(String(value || "").replace(/[₱,]/g, "")) || 0;
  }

  function formatPeso(value) {
    return "₱" + Number(value || 0).toLocaleString("en-PH", {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }

  // Read scheme JSON (must be valid JSON in DB)
  function safeParseScheme() {
    const raw = (schemeEl?.value || schemeEl?.textContent || "").trim();
    if (!raw) return null;
    try {
      return JSON.parse(raw);
    } catch (e) {
      console.warn("Invalid scheme JSON:", e, raw);
      return null;
    }
  }

  function planKeyFromSelect(value) {
    const v = String(value || "").toLowerCase().trim();
    if (v === "annual") return "annual";
    if (v === "semestral") return "semestral";
    if (v === "quarterly") return "quarterly";
    if (v === "monthly") return "monthly";
    return "";
  }

  function getSchemePaymentTotal(planKey) {
    const scheme = safeParseScheme();
    if (!scheme) return 0;
    const totals = scheme.payment_totals || {};
    const rawVal = totals[planKey];
    const n = (typeof rawVal === "number") ? rawVal : parseFloat(String(rawVal));
    return isFinite(n) ? n : 0;
  }

  function isSeniorHighGrade(gradeLabel) {
    const s = String(gradeLabel || "").toLowerCase();
    const m = s.match(/(\d+)/);
    if (!m) return false;
    const n = parseInt(m[1], 10);
    return n >= 11;
  }

  function getBreakdownDivisor(planKey) {
    const senior = isSeniorHighGrade(gradeLevelEl?.value);

    if (planKey === "annual") return 1;
    if (planKey === "semestral") return 2;

    if (!senior) {
      // Nursery–Grade 10
      if (planKey === "quarterly") return 4;
      if (planKey === "monthly") return 9;
      return 1;
    } else {
      // Grade 11–12
      if (planKey === "monthly") return 4;
      // quarterly shouldn't exist, but fallback:
      if (planKey === "quarterly") return 4;
      return 1;
    }
  }

  function getBreakdownLabel(planKey, divisor) {
    const senior = isSeniorHighGrade(gradeLevelEl?.value);

    if (planKey === "annual") return "";
    if (planKey === "semestral") return "Per Semester";
    if (planKey === "quarterly") return "Per Quarter";
    if (planKey === "monthly") return senior ? "Per Month (4 months)" : "Per Month (9 months)";
    return "Installment";
  }

  function updateDiscount() {
    const tuitionFee = parsePeso(tuitionInput.value);
    const type = discountType.value;

    let val = parseFloat(discountValue.value) || 0;
    let discount = 0;

    if (!type) {
      discountValue.disabled = true;
      discountValue.value = 0;
      discount = 0;
    } else {
      discountValue.disabled = false;

      if (type === "percent") {
        if (val > 100) { val = 100; discountValue.value = 100; }
        discount = (tuitionFee * val) / 100;
      } else if (type === "fixed") {
        if (val > tuitionFee) { val = tuitionFee; discountValue.value = tuitionFee; }
        discount = val;
      }
    }

    if (discount > tuitionFee) discount = tuitionFee;
    discountAmt.value = formatPeso(discount);

    updateSummary();
  }

  function updateSummary() {
    const regFee  = parsePeso(regFeeInput.value);
    const tuition = parsePeso(tuitionInput.value);
    const misc    = parsePeso(miscInput.value);
    const uniform = parsePeso(uniformInput.value);
    const discount = parsePeso(discountAmt.value);
    const down    = parseFloat(downInput.value) || 0;

    const tuitionMiscLessDiscount = Math.max(0, tuition + misc - discount);

    const planKey = planKeyFromSelect(planSelect.value);
    const basePlanTotal = planKey ? getSchemePaymentTotal(planKey) : 0;

    // Payment total (you can change this if you don't want discount to affect plan total)
    const paymentTotal = Math.max(0, basePlanTotal - discount);

    // Amount to pay today
    const amountToPayToday = regFee + uniform + down;

    // Breakdown divisor
    const divisor = getBreakdownDivisor(planKey);
    const hasBreakdown = (planKey && planKey !== "annual" && divisor > 1 && paymentTotal > 0);

    // installment
    const installment = hasBreakdown ? (paymentTotal / divisor) : 0;
    const breakdownLabel = getBreakdownLabel(planKey, divisor);

    // Update list values by label
    summaryLis.forEach((li) => {
      const label = li.querySelector("span:first-child")?.textContent?.trim();
      const valueSpan = li.querySelector("span:last-child");
      if (!label || !valueSpan) return;

      switch (label) {
        case "Tuition Fee":
          valueSpan.textContent = formatPeso(tuition);
          break;
        case "Miscellaneous":
          valueSpan.textContent = formatPeso(misc);
          break;
        case "Discount":
          valueSpan.textContent = formatPeso(discount);
          break;
        case "Tuition + Misc - Discount":
          valueSpan.textContent = formatPeso(tuitionMiscLessDiscount);
          break;
        case "Registration Fee":
          valueSpan.textContent = formatPeso(regFee);
          break;
        case "Uniform":
          valueSpan.textContent = formatPeso(uniform);
          break;
        case "Downpayment":
          valueSpan.textContent = formatPeso(down);
          break;
        case "Amount to Pay Today":
          valueSpan.textContent = formatPeso(amountToPayToday);
          break;
      }
    });

    // Payment total UI + hidden submit
    if (paymentTotalDisplay) paymentTotalDisplay.textContent = formatPeso(paymentTotal);
    if (paymentTotalHidden)  paymentTotalHidden.value = String(paymentTotal.toFixed(2));

    // Breakdown UI + hidden submit
    if (!planKey) {
      breakdownSummaryEl.textContent = "—";
      breakdownLabelEl.textContent = "Installment";
      breakdownAmountEl.textContent = "₱0";
      installmentCountHidden.value = "0";
      installmentAmountHidden.value = "0";
    } else if (planKey === "annual") {
      breakdownSummaryEl.textContent = "No breakdown (Annual)";
      breakdownLabelEl.textContent = "Installment";
      breakdownAmountEl.textContent = "—";
      installmentCountHidden.value = "1";
      installmentAmountHidden.value = String(paymentTotal.toFixed(2));
    } else {
      breakdownSummaryEl.textContent = divisor + " payments";
      breakdownLabelEl.textContent = breakdownLabel;
      breakdownAmountEl.textContent = formatPeso(installment);

      installmentCountHidden.value = String(divisor);
      installmentAmountHidden.value = String(installment.toFixed(2));
    }
  }

  // Expose for uniform cart script
  window.updateSummary = updateSummary;

  // Events
  planSelect.addEventListener("change", updateSummary);

  discountType.addEventListener("change", updateDiscount);
  discountValue.addEventListener("input", updateDiscount);

  downInput.addEventListener("input", updateSummary);
  uniformInput.addEventListener("input", updateSummary);

  // Init
  discountValue.disabled = !discountType.value;
  updateDiscount(); // triggers updateSummary
});
</script>
