   <!-- Navbar with Mobile Hamburger Menu and Overlay -->
   <nav class="bg-white border-b border-gray-200">
       <div class="container mx-auto flex justify-between items-center p-4">
           <!-- Logo -->
           <a class="text-dark text-xl font-semibold" href="#">My Blog</a>

           <!-- Search and Toggle Button for Mobile -->
           <div class="flex items-center space-x-2 lg:hidden">
               <!-- Search Icon (Visible on Mobile) -->
               <a class="text-dark hover:text-gray-700" href="?p=searchpage">
                   <i class="fa-solid fa-magnifying-glass w-6 h-6"></i>
               </a>

               <!-- Hamburger Menu Button (Visible on Mobile) -->
               <button id="menu-btn" class="text-gray-500 hover:text-gray-700 focus:outline-none" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                   </svg>
               </button>
           </div>

           <!-- Navigation Links (Hidden on mobile, visible on large screens) -->
           <div id="navbarNav" class="hidden lg:flex flex-col lg:flex-row space-y-2 lg:space-y-0 lg:space-x-4 mt-4 lg:mt-0">
               <ul class="flex flex-col lg:flex-row lg:space-x-6">
                   <li><a class="text-dark hover:text-gray-700" href="index.php">Home</a></li>
                   <li><a class="text-dark hover:text-gray-700" href="#">About</a></li>
                   <li><a class="text-dark hover:text-gray-700" href="#">Blog</a></li>
                   <li><a class="text-dark hover:text-gray-700" href="#">Contact</a></li>
                   <li>
                       <a class="text-dark hover:text-gray-700 hidden lg:inline" href="?p=searchpage">
                           <i class="fa-solid fa-magnifying-glass"></i>
                       </a>
                   </li>
               </ul>
           </div>
       </div>
   </nav>

   <!-- Mobile Menu (Partially Slide In) -->
   <div id="mobileMenu" class="fixed top-0 left-0 w-4/5 max-w-xs h-full bg-white z-50 hidden transition-transform transform -translate-x-full lg:hidden shadow-lg">
       <div class="container mx-auto p-4">
           <!-- Close Button -->
           <button id="close-btn" class="text-gray-500 hover:text-gray-700 focus:outline-none" aria-label="Close menu">
               <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
               </svg>
           </button>

           <!-- Menu Links -->
           <ul class="mt-8 space-y-4">
               <li><a class="text-dark hover:text-gray-700" href="?p=home">Home</a></li>
               <li><a class="text-dark hover:text-gray-700" href="#">About</a></li>
               <li><a class="text-dark hover:text-gray-700" href="#">Blog</a></li>
               <li><a class="text-dark hover:text-gray-700" href="#">Contact</a></li>
               <li>
                   <a class="text-dark hover:text-gray-700" href="?p=searchpage">
                       <i class="fa-solid fa-magnifying-glass"></i>
                   </a>
               </li>
           </ul>
       </div>
   </div>

   <!-- Background Dim Overlay -->
   <div id="menuOverlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

   <!-- JavaScript for Mobile Menu Toggle, Swipe Gesture, and Background Dim -->
   <script>
       const menuBtn = document.getElementById('menu-btn');
       const mobileMenu = document.getElementById('mobileMenu');
       const closeBtn = document.getElementById('close-btn');
       const menuOverlay = document.getElementById('menuOverlay');
       const body = document.body;

       // Toggle Mobile Menu (Show)
       menuBtn.addEventListener('click', () => {
           mobileMenu.classList.remove('-translate-x-full');
           mobileMenu.classList.add('translate-x-0');
           mobileMenu.classList.remove('hidden');
           menuOverlay.classList.remove('hidden');
           body.classList.add('overflow-hidden'); // Disable scrolling when menu is open
       });

       // Close Mobile Menu
       function closeMenu() {
           mobileMenu.classList.add('-translate-x-full');
           mobileMenu.classList.remove('translate-x-0');
           setTimeout(() => {
               mobileMenu.classList.add('hidden');
               menuOverlay.classList.add('hidden');
               body.classList.remove('overflow-hidden'); // Re-enable scrolling
           }, 300); // Match the duration of the CSS transition
       }

       closeBtn.addEventListener('click', closeMenu);

       // Close the menu if overlay is clicked
       menuOverlay.addEventListener('click', closeMenu);

       // Swipe Gesture for Closing the Menu
       let touchStartX = 0;

       mobileMenu.addEventListener('touchstart', (event) => {
           touchStartX = event.touches[0].clientX;
       });

       mobileMenu.addEventListener('touchmove', (event) => {
           const touchEndX = event.touches[0].clientX;
           if (touchEndX < touchStartX) { // Swipe Left to Close
               closeMenu();
           }
       });
   </script>

   <!-- Tailwind CSS Styling -->
   <style>
       /* Custom transitions for sliding the mobile menu */
       #mobileMenu {
           transition: transform 0.3s ease-in-out;
       }

       /* Custom transitions for fading in/out the background overlay */
       #menuOverlay {
           transition: opacity 0.3s ease-in-out;
       }
   </style>