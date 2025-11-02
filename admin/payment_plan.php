<?php
include 'session_login.php';
include '../db_connection.php';

$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$grade_level = isset($_GET['grade']) ? $_GET['grade'] : '';

$tuition_fee = 0.00;
$miscellaneous = 0.00;
$total = 0.00;

if (!empty($grade_level)) {
    $query = "SELECT tuition_fee, miscellaneous FROM tuition_fees WHERE grade_level = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $grade_level);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $tuition_fee = floatval($row['tuition_fee']);
        $miscellaneous = floatval($row['miscellaneous']);
        $total = $tuition_fee + $miscellaneous;
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
                <option value="Quarterly">Quarterly (4 Quarters)</option>
                <option value="Monthly">Monthly (9 Months)</option>
              </select>
            </div>

           <div class="col-md-6">
            <label for="enrolled_section" class="form-label text-muted">Enrolled Section</label>
            <select id="enrolled_section" name="enrolled_section" class="form-select" required>
              <option value="">-- Select Section --</option>
            <?php
                // Get current and next school year (format: YYYY-YYYY)
                $currentYear = date("Y");
                $nextYear = $currentYear + 1;
                $currentSchoolYear = $currentYear . "-" . $nextYear;
                $nextSchoolYear = $nextYear . "-" . ($nextYear + 1);

                $sql = "SELECT section_id, section_name, grade_level, room, strand, teacher_id, capacity, enrolled, school_year 
                        FROM sections 
                        WHERE grade_level = '$grade_level'
                        AND school_year IN ('$currentSchoolYear', '$nextSchoolYear')
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

                        // ✅ Skip if section is already full
                        if ($capacity == $enrolled) {
                            continue;
                        }

                        // Build label
                        $label = "{$sectionName} ( {$gradeLevel}";
                        if (!empty($room)) {
                            $label .= ", Room {$room}";
                        }
                        // Show strand only if Grade 11 or 12
                        if (($gradeLevel == "11" || $gradeLevel == "12") && !empty($strand)) {
                            $label .= ", Strand: {$strand}";
                        }
                        $label .= ") - {$enrolled}/{$capacity} students";

                        echo "<option value='{$sectionId}'>{$label} [SY: {$schoolYear}]</option>";
                        $hasAvailable = true;
                    }

                    // ✅ If all were full
                    if (!$hasAvailable) {
                        echo "<option value='' disabled selected>-- All sections are full --</option>";
                    }
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
              <input type="text" class="form-control" value="₱<?= number_format($miscellaneous, 2) ?>" readonly>
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Uniform</label>
              <input type="text" id="uniform" name="uniform" class="form-control" readonly>
            </div>

            <div class="col-md-3">
                <label class="form-label text-muted">Discount Type</label>
                <select name="discount_type" id="discount_type" class="form-control">
                  <option value="">None</option>
                  <option value="percent">Percent (%)</option>
                  <option value="fixed">Fixed Amount (₱)</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Discount Value</label>
                <input type="number" name="discount_value" disabled id="discount_value" class="form-control" value="0" min="0" step="0.01">
              </div>

              <div class="col-md-3">
                <label class="form-label text-muted">Discount Amount (Tuition Fee)</label>
                <input type="text" name="discount_amount" id="discount_amount" readonly class="form-control" value="₱0.00">
              </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Downpayment</label>
              <input type="number" name="down" id="down" class="form-control" value="0" min="0" step="0.01">
            </div>


            <?php
             // Fetch uniforms from DB
            // Fetch uniforms from DB
            $sql = "SELECT id, grade_level, gender, classification, type, size, price FROM uniforms ORDER BY grade_level, classification, type";
            $result = mysqli_query($conn, $sql);
            ?>

            <div class="col-md-6">
                <div class="border mt-3 rounded-4 p-3 bg-white" id="payment_breakdown">
                  <h6 class="fw-bold mb-3 fw-bold">Transaction Summary</h6>

                  <ul class="list-group list-unstyled list-group-flush">

                  <!-- Group: Fees & Discounts -->
                  <li class="list-group-items-iii p-2 bg-light text-muted fw-bold">
                    Fees & Discounts
                  </li>
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

                  <!-- Horizontal line separator -->
                  <li class="list-group-items-iii p-0">
                    <hr class="my-2">
                  </li>

                  <!-- Group: Initial Payments -->
                  <li class="list-group-items-iii p-2 bg-light text-muted fw-bold">
                    Initial Payments
                  </li>
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

                  <!-- Group: Total -->
                  <li class="list-group-items-iii d-flex justify-content-between align-items-center p-2 mt-2 border-top">
                    <span class="fw-bold">Amount to Pay</span>
                    <span class="fw-bold">₱0</span>
                  </li>

                </ul>


                  <!-- Checkbox -->
                  <div class="form-check ms-3 mt-3">
                    <input class="form-check-input" type="checkbox" id="reviewed-check">
                    <label class="form-check-label text-muted" for="reviewed-check">
                      I confirm that all data has been reviewed
                    </label>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6">
                      

                      <!-- Enroll Button -->
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
                      <a href="view_enrollment.php?id=<?php echo htmlspecialchars($admission_id)?>" class="btn btn-outline-danger text-danger border-2 rounded-4 mt-3 w-100">Back</a>
                    </div>
                  </div>
                </div>
              </div>

            <!-- Uniforms Section -->
            <div class="col-md-6">
              <div class="border mt-3 rounded-4 p-3">
                <h6 class="mb-3 fw-bold">Uniform Details</h6>

                <!-- Add Uniform Row -->
                <div class="row g-2 align-items-end">
                  <div class="col-md-5">
                    <label class="form-label text-muted small mb-1">Uniform</label>
                    <select class="form-select form-select-sm" id="uniformName">
                      <option value="">-- Select Uniform --</option>
                      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <option 
                          value="<?= $row['id'] ?>" 
                          data-name="<?= htmlspecialchars($row['grade_level'] . ' - ' . $row['classification'] . ' - ' . $row['type']) ?>"
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

                <!-- Added Uniforms List -->
                <ul class="list-group list-group-flush mt-3 p-0" id="uniformList"></ul>

                <!-- Bootstrap Icons (if not already included) -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

                <script>
                    function calculateUniformTotal() {
                      let total = 0;
                      document.querySelectorAll("#uniformList .item-total").forEach(item => {
                        let value = parseFloat(item.textContent.replace("₱", "").replace(",", ""));
                        total += value;
                      });
                      document.getElementById("uniform").value = "₱" + total.toFixed(2);
                    }

                    function updateUniformCartText() {
                      let cartTextarea = document.getElementById("uniform_cart");
                      let cart = [];

                      document.querySelectorAll("#uniformList li").forEach(li => {
                        let name = li.querySelector("strong").textContent;
                        let qty = parseInt(li.querySelector(".item-qty").textContent.replace("x", ""));
                        let total = parseFloat(li.querySelector(".item-total").textContent.replace("₱", "").replace(",", ""));
                        let details = li.querySelector("small").textContent;

                        // Extract gender & size from the details text
                        let genderMatch = details.match(/(Male|Female|Unisex)/);
                        let sizeMatch = details.match(/Size:\s*(\w+)/);

                        cart.push({
                          name: name,
                          quantity: qty,
                          total: total,
                          gender: genderMatch ? genderMatch[1] : "",
                          size: sizeMatch ? sizeMatch[1] : ""
                        });
                      });

                      cartTextarea.value = JSON.stringify(cart, null, 2); // pretty format
                    }

                    // Auto fill price when selecting uniform
                    document.getElementById("uniformName").addEventListener("change", function() {
                      let price = this.options[this.selectedIndex].getAttribute("data-price");
                      document.getElementById("uniformPrice").value = price ? "₱" + parseFloat(price).toFixed(2) : "";
                    });

                    // Add to cart
                    document.getElementById("addUniformBtn").addEventListener("click", function() {
                      let select = document.getElementById("uniformName");
                      let qty = parseInt(document.getElementById("uniformQty").value);
                      let price = select.options[select.selectedIndex].getAttribute("data-price");
                      let name = select.options[select.selectedIndex].getAttribute("data-name");
                      let gender = select.options[select.selectedIndex].getAttribute("data-gender");
                      let size = select.options[select.selectedIndex].getAttribute("data-size");
                      let id = select.value;

                      if (!id || !price || qty < 1) {
                        alert("Please select a uniform and quantity.");
                        return;
                      }

                      let total = qty * parseFloat(price);
                      let uniformList = document.getElementById("uniformList");

                      // Check if item already exists in list
                      let existing = uniformList.querySelector(`li[data-id="${id}"]`);

                      if (existing) {
                        // update qty & total
                        let qtySpan = existing.querySelector(".item-qty");
                        let totalSpan = existing.querySelector(".item-total");

                        let currentQty = parseInt(qtySpan.textContent.replace("x", ""));
                        let newQty = currentQty + qty;

                        qtySpan.textContent = "x" + newQty;
                        totalSpan.textContent = "₱" + (newQty * parseFloat(price)).toFixed(2);

                      } else {
                        // create new item with delete button
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

                        // delete handler
                        li.querySelector(".btn-delete").addEventListener("click", function() {
                          li.remove();
                          calculateUniformTotal();
                          updateSummary();
                          updateUniformCartText();
                        });
                      }

                      // recalc total + update summary + textarea
                      calculateUniformTotal();
                      updateSummary();
                      updateUniformCartText();

                      // reset qty
                      document.getElementById("uniformQty").value = 1;
                    });
                  </script>




              </div>
            </div>


            <script>
              $(document).ready(function () {
                // Enable searchable dropdown
                $('#uniformName').select2({
                  placeholder: "Select Uniform",
                  allowClear: true,
                  width: '100%'
                });

                // Auto update price when uniform is selected
                $('#uniformName').on('change', function () {
                  let price = $(this).find(':selected').data('price');
                  $('#uniformPrice').val(price ? price : '');
                });
              });
            </script>






            <div class="col-md-12">
              <textarea id="uniform_cart" class="w-100" hidden name="uniform_cart" ></textarea>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
  const tuitionInput = document.getElementById("tuition_fee");
  const discountType = document.getElementById("discount_type");
  const discountValue = document.getElementById("discount_value");
  const discountAmount = document.getElementById("discount_amount");

  // disable by default
  discountValue.disabled = true;

  function parseCurrency(value) {
    return parseFloat(value.replace(/[₱,]/g, "")) || 0;
  }

  function formatCurrency(value) {
    return "₱" + value.toLocaleString("en-PH", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  function updateDiscount() {
    const tuitionFee = parseCurrency(tuitionInput.value);
    const type = discountType.value;
    let value = parseFloat(discountValue.value) || 0;
    let discount = 0;

    if (type === "") {
      discountValue.disabled = true;
      discountValue.value = 0;
      discount = 0;
    } else {
      discountValue.disabled = false;

      if (type === "percent") {
        // cap percent at 100
        if (value > 100) {
          value = 100;
          discountValue.value = 100;
        }
        discount = (tuitionFee * value) / 100;
      } else if (type === "fixed") {
        // cap fixed discount at tuition fee
        if (value > tuitionFee) {
          value = tuitionFee;
          discountValue.value = tuitionFee;
        }
        discount = value;
      }
    }

    if (discount > tuitionFee) discount = tuitionFee; // avoid exceeding tuition

    discountAmount.value = formatCurrency(discount);
  }

  discountType.addEventListener("change", updateDiscount);
  discountValue.addEventListener("input", updateDiscount);
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
  const plan = document.getElementById("payment_plan");
  const regFeeInput = document.querySelector("input[name='downpayment']");
  const tuitionInput = document.getElementById("tuition_fee");
  const miscInput = document.querySelector("input[value^='₱'][readonly]:not(#tuition_fee):not([name='downpayment'])");
  const uniformInput = document.getElementById("uniform");
  const discountType = document.getElementById("discount_type");
  const discountValue = document.getElementById("discount_value");
  const discountAmount = document.getElementById("discount_amount");
  const downInput = document.getElementById("down");

  // Map summary spans in the correct order
  const summaryLis = document.querySelectorAll(".list-group-items-iii");
  
  function parsePeso(value) {
    return parseFloat(value.replace(/[₱,]/g, "")) || 0;
  }

  function formatPeso(value) {
    return "₱" + value.toLocaleString("en-PH", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  window.updateSummary = function () {
    const regFee = parsePeso(regFeeInput.value);
    const tuition = parsePeso(tuitionInput.value);
    const misc = parsePeso(miscInput.value);
    const uniform = parsePeso(uniformInput.value);
    let discount = 0;

    // Calculate discount
    if (discountType.value === "percent") {
      let percent = parseFloat(discountValue.value) || 0;
      if (percent > 100) percent = 100;
      discount = (tuition * percent) / 100;
    } else if (discountType.value === "fixed") {
      discount = parseFloat(discountValue.value) || 0;
      if (discount > tuition) discount = tuition;
    }

    discountAmount.value = formatPeso(discount);

    const down = parseFloat(downInput.value) || 0;

    // Amount to Pay = Reg Fee + Uniform + Downpayment
    const amountToPay = regFee + uniform + down;

    // Update summary UI in correct order
    // summaryLis mapping:
    // 0: Tuition Fee
    // 1: Miscellaneous
    // 2: Discount
    // 3: <hr> -> skip
    // 4: Registration Fee
    // 5: Uniform
    // 6: Downpayment
    // 7: Amount to Pay

    summaryLis.forEach((li) => {
      const label = li.querySelector("span:first-child")?.textContent.trim();
      const valueSpan = li.querySelector("span:last-child");
      if (!valueSpan) return;

      switch(label) {
        case "Tuition Fee":
          valueSpan.textContent = formatPeso(tuition);
          break;
        case "Miscellaneous":
          valueSpan.textContent = formatPeso(misc);
          break;
        case "Discount":
          valueSpan.textContent = formatPeso(discount);
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
        case "Amount to Pay":
          valueSpan.textContent = formatPeso(amountToPay);
          break;
      }
    });
  };

  // Enable/disable discount input
  discountType.addEventListener("change", () => {
    discountValue.disabled = discountType.value === "";
    if (discountType.value === "") {
      discountValue.value = 0;
    }
    updateSummary();
  });

  // Listen to changes
  [plan, regFeeInput, tuitionInput, miscInput, uniformInput, discountType, discountValue, downInput]
    .forEach(el => el.addEventListener("input", updateSummary));

  // Initial update
  updateSummary();
});
</script>
