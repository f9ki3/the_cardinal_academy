<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }
        
        .announcement-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-left: 4px solid;
            transform: scale(1);
        }
        
        .announcement-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px) scale(1.01);
        }
        
        .announcement-card.important {
            border-left-color: #EF4444;
        }
        
        .announcement-card.warning {
            border-left-color: #F59E0B;
        }
        
        .announcement-card.info {
            border-left-color: #3B82F6;
        }
        
        .announcement-card.success {
            border-left-color: #10B981;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .filter-button.active {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #3B82F6;
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Announcements</h1>
                <p class="text-gray-600">Stay updated with the latest news and updates</p>
            </div>
            
        </div>
        
        <div class="mb-6 flex flex-wrap gap-3">
            <button class="filter-button active px-4 py-2 rounded-full bg-blue-100 text-blue-800 font-medium" data-filter="all">
                All
            </button>
            <button class="filter-button px-4 py-2 rounded-full bg-red-100 text-red-800 font-medium" data-filter="important">
                Important
            </button>
            <button class="filter-button px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-medium" data-filter="warning">
                Warning
            </button>
            <button class="filter-button px-4 py-2 rounded-full bg-green-100 text-green-800 font-medium" data-filter="success">
                Success
            </button>
            <button class="filter-button px-4 py-2 rounded-full bg-indigo-100 text-indigo-800 font-medium" data-filter="info">
                Information
            </button>
        </div>
        
        <div id="announcement-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Announcement cards will be dynamically inserted here -->
            <div class="announcement-card info bg-white rounded-lg p-5 relative fade-in">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-xs font-semibold px-2 py-1 rounded bg-blue-100 text-blue-800">Information</span>
                    <div class="text-gray-500 text-xs">May 15, 2023</div>
                </div>
                <h3 class="font-bold text-lg mb-2">System Maintenance Scheduled</h3>
                <p class="text-gray-600 mb-4">We will be performing scheduled maintenance this Saturday from 2:00 AM to 4:00 AM EST. Services may be temporarily unavailable during this period.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        2 days ago
                    </div>
                    <div class="relative">
                        <img src="https://placehold.co/40x40" alt="System admin avatar" class="w-8 h-8 rounded-full object-cover">
                        <span class="notification-badge bg-blue-500 text-white">1</span>
                    </div>
                </div>
            </div>
            
            <div class="announcement-card important bg-white rounded-lg p-5 relative fade-in">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-xs font-semibold px-2 py-1 rounded bg-red-100 text-red-800">Important</span>
                    <div class="text-gray-500 text-xs">May 14, 2023</div>
                </div>
                <h3 class="font-bold text-lg mb-2">Security Update Required</h3>
                <p class="text-gray-600 mb-4">All users must update their passwords immediately due to a security vulnerability. Please change your password before May 20th.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        3 days ago
                    </div>
                    <div class="relative">
                        <img src="https://placehold.co/40x40" alt="Security officer avatar" class="w-8 h-8 rounded-full object-cover">
                        <span class="notification-badge bg-red-500 text-white">3</span>
                    </div>
                </div>
            </div>
            
            <div class="announcement-card success bg-white rounded-lg p-5 relative fade-in">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-xs font-semibold px-2 py-1 rounded bg-green-100 text-green-800">Success</span>
                    <div class="text-gray-500 text-xs">May 12, 2023</div>
                </div>
                <h3 class="font-bold text-lg mb-2">Quarterly Goals Achieved</h3>
                <p class="text-gray-600 mb-4">Congratulations to the entire team for achieving our Q2 targets ahead of schedule! We've seen a 32% growth in user engagement.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        5 days ago
                    </div>
                    <div class="relative">
                        <img src="https://placehold.co/40x40" alt="CEO avatar" class="w-8 h-8 rounded-full object-cover">
                    </div>
                </div>
            </div>
            
            <div class="announcement-card warning bg-white rounded-lg p-5 relative fade-in">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-xs font-semibold px-2 py-1 rounded bg-yellow-100 text-yellow-800">Warning</span>
                    <div class="text-gray-500 text-xs">May 10, 2023</div>
                </div>
                <h3 class="font-bold text-lg mb-2">API Rate Limits Changing</h3>
                <p class="text-gray-600 mb-4">Starting June 1st, API rate limits will be reduced from 1000 to 800 requests per minute. Please update your applications accordingly.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        1 week ago
                    </div>
                    <div class="relative">
                        <img src="https://placehold.co/40x40" alt="Developer relations manager avatar" class="w-8 h-8 rounded-full object-cover">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- New Announcement Modal (hidden by default) -->
        <div id="new-announcement-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Create New Announcement</h2>
                    <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="announcement-form" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea required rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="info">Information</option>
                            <option value="important">Important</option>
                            <option value="warning">Warning</option>
                            <option value="success">Success</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" id="cancel-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-button');
            const announcementCards = document.querySelectorAll('.announcement-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const filter = button.getAttribute('data-filter');
                    
                    // Update active button styling
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    
                    // Filter announcements
                    announcementCards.forEach(card => {
                        if (filter === 'all' || card.classList.contains(filter)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Modal functionality
            const newAnnouncementBtn = document.getElementById('new-announcement-btn');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelBtn = document.getElementById('cancel-btn');
            const modal = document.getElementById('new-announcement-modal');
            
            newAnnouncementBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });
            
            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
            
            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
            
            // Form submission for new announcements
            const form = document.getElementById('announcement-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const title = this.elements[0].value;
                const message = this.elements[1].value;
                const type = this.elements[2].value;
                
                // Create new announcement card
                const announcementContainer = document.getElementById('announcement-container');
                const announcementCard = document.createElement('div');
                
                // Map type to card styling
                const typeStyles = {
                    'info': { bg: 'bg-blue-100', text: 'text-blue-800', label: 'Information' },
                    'important': { bg: 'bg-red-100', text: 'text-red-800', label: 'Important' },
                    'warning': { bg: 'bg-yellow-100', text: 'text-yellow-800', label: 'Warning' },
                    'success': { bg: 'bg-green-100', text: 'text-green-800', label: 'Success' }
                };
                
                const date = new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                
                announcementCard.classList.add('announcement-card', type, 'bg-white', 'rounded-lg', 'p-5', 'relative', 'fade-in');
                announcementCard.innerHTML = `
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-xs font-semibold px-2 py-1 rounded ${typeStyles[type].bg} ${typeStyles[type].text}">${typeStyles[type].label}</span>
                        <div class="text-gray-500 text-xs">${date}</div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">${title}</h3>
                    <p class="text-gray-600 mb-4">${message}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Just now
                        </div>
                        <div class="relative">
                            <img src="https://placehold.co/40x40" alt="User avatar" class="w-8 h-8 rounded-full object-cover">
                            <span class="notification-badge bg-blue-500 text-white">!</span>
                        </div>
                    </div>
                `;
                
                // Insert at the beginning
                announcementContainer.insertBefore(announcementCard, announcementContainer.firstChild);
                
                // Close modal and reset form
                modal.classList.add('hidden');
                form.reset();
                
                // Apply any active filter
                const activeFilter = document.querySelector('.filter-button.active').getAttribute('data-filter');
                if (activeFilter !== 'all' && !announcementCard.classList.contains(activeFilter)) {
                    announcementCard.style.display = 'none';
                }
            });
        });
    </script>
     
              </div> 

            </div> <!-- end inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }
        
        .announcement-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-left: 4px solid;
            transform: scale(1);
        }
        
        .announcement-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px) scale(1.01);
        }
        
        .announcement-card.important {
            border-left-color: #EF4444;
        }
        
        .announcement-card.warning {
            border-left-color: #F59E0B;
        }
        
        .announcement-card.info {
            border-left-color: #3B82F6;
        }
        
        .announcement-card.success {
            border-left-color: #10B981;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .filter-button.active {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #3B82F6;
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    
</body>
</html>
