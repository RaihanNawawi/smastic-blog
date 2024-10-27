 <!-- Footer -->
 <footer class="bg-black text-white py-10">
     <div class="container mx-auto px-6">
         <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start">
             <!-- School Information Section with Logo -->
             <div class="lg:w-1/3 mb-8 lg:mb-0 text-center lg:text-left">
                 <img src="https://siakadponpes.com/assets/img/clients/6.png" alt="SMA Sains Tahfizh Logo" class="mx-auto lg:mx-0 mb-4" style="max-width: 150px;">
                 <h4 class="font-bold text-xl text-green-400">SMA Sains Tahfizh</h4>
                 <p class="text-green-200">Islamic Center Siak</p>
                 <p class="mt-4 text-gray-300 leading-relaxed">
                     Alamat Sekolah:<br>
                     Komplek. Islamic Center Kampung Rempak<br>
                     Provinsi Kec. Siak, Kab. Siak - Riau, Indonesia
                 </p>
             </div>

             <!-- Contact Details -->
             <div class="lg:w-1/3 mb-8 lg:mb-0 text-center lg:text-left">
                 <ul class="text-gray-300 space-y-4">
                     <li class="flex items-center justify-center lg:justify-start">
                         <i class="fas fa-phone-alt mr-2 text-green-400"></i>
                         <span>Phone: (0764) 3249465</span>
                     </li>
                     <li class="flex items-center justify-center lg:justify-start">
                         <i class="fas fa-envelope mr-2 text-green-400"></i>
                         <span>Email: <a href="mailto:smastics@gmail.com" class="hover:text-white">smastics@gmail.com</a></span>
                     </li>
                     <li class="flex items-center justify-center lg:justify-start">
                         <i class="fas fa-globe mr-2 text-green-400"></i>
                         <span>Website: <a href="http://www.smastic.sch.id" class="hover:text-white">www.smastic.sch.id</a></span>
                     </li>
                 </ul>
             </div>

             <!-- Blog and Social Media Section -->
             <div class="lg:w-1/3 text-center lg:text-left">
                 <h4 class="font-bold text-lg mb-4">Stay Connected</h4>
                 <div class="flex justify-center lg:justify-start space-x-4 mb-6">
                     <a href="https://www.facebook.com/share/g4kocCusPFdRtJ8U/" target='_blank' class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                     <a href="https://youtube.com/@smasticofficial?si=GoqizrA1K9zlRhvP" target='_blank' class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                     <a href="https://www.instagram.com/smasticsofficial?igsh=MWJ1bnlodzNtdWZ6cQ==" target='_blank' class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                 </div>
                 <h4 class="font-bold text-lg mb-4">Explore Our Blog</h4>
                 <ul class="text-gray-300 space-y-2">
                     <?php
                        $query = $kon->query("SELECT * FROM categories ORDER BY id DESC");
                        foreach ($query as $key) { ?>
                         <li><a href="main.php?p=categorypage&id=<?= $key['id'] ?>" class="hover:text-white"><?= $key['name'] ?></a></li>
                     <?php } ?>
                 </ul>
             </div>
         </div>

         <!-- Footer Bottom Text -->
         <div class="mt-10 text-center text-sm text-gray-500">
             <p>&copy; 2024 SMA Sains Tahfizh. All rights reserved.</p>
         </div>
     </div>
 </footer>