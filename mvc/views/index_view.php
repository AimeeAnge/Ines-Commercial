<?php
// mvc/views/index_view.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | University of Ines Students Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Manrope', sans-serif; }
        .hero-gradient {
            background: radial-gradient(circle at top right, #13ec25 0%, #102212 100%);
        }
    </style>
</head>
<body class="bg-[#f6f8f6] text-[#102212]">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-[#13ec25] rounded-lg p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#102212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <h1 class="text-2xl font-black tracking-tighter">INES<span class="text-[#facc15]">PRO</span></h1>
            </div>
            <div class="hidden md:flex items-center gap-8 font-bold text-sm">
                <a href="#about" class="hover:text-[#13ec25] transition-colors">About</a>
                <a href="#announcements" class="hover:text-[#13ec25] transition-colors">Announcements</a>
                <a href="#featured" class="hover:text-[#13ec25] transition-colors">Marketplace</a>
                <div class="flex items-center gap-4 pl-8 border-l border-slate-100">
                    <a href="signup.php" class="text-[#102212] hover:text-[#13ec25] transition-colors">Sign Up</a>
                    <a href="login.php" class="bg-[#102212] text-white px-6 py-3 rounded-xl hover:bg-[#13ec25] hover:text-[#102212] transition-all">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="hero-gradient rounded-[60px] p-12 md:p-24 text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest border border-white/20 mb-6">
                        Official Student Marketplace
                    </span>
                    <h2 class="text-5xl md:text-7xl font-black leading-tight mb-8">
                        Empowering <span class="text-[#facc15]">INES</span> Students Through Commerce.
                    </h2>
                    <p class="text-lg md:text-xl text-slate-300 font-medium mb-12">
                        The exclusive platform for University of Ines students to trade, sell, and grow their entrepreneurial ventures. Built by students, for students.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#featured" class="bg-[#13ec25] text-[#102212] px-8 py-4 rounded-2xl font-black shadow-xl shadow-[#13ec25]/20 hover:scale-105 transition-all">Explore Marketplace</a>
                        <a href="signup.php" class="bg-white/10 backdrop-blur-md border border-white/20 px-8 py-4 rounded-2xl font-black hover:bg-white/20 transition-all">Start Selling Now</a>
                    </div>
                </div>
                <!-- Abstract Decoration -->
                <div class="absolute top-0 right-0 w-1/2 h-full opacity-20 pointer-events-none">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <path fill="#FFFFFF" d="M44.7,-76.4C58.2,-69.2,70,-58.5,78.5,-45.4C87,-32.3,92.2,-16.2,91.3,-0.5C90.4,15.1,83.4,30.3,73.8,43.3C64.2,56.3,52,67.1,38.1,74.1C24.2,81.1,8.6,84.3,-7.1,82.9C-22.8,81.5,-38.6,75.5,-51.7,66.4C-64.8,57.3,-75.2,45.1,-81.2,31.1C-87.2,17.1,-88.8,1.3,-86.3,-14.1C-83.8,-29.5,-77.2,-44.5,-66.1,-55.5C-55,-66.5,-39.4,-73.5,-24.5,-78.9C-9.6,-84.3,4.6,-88.1,19.3,-86.3C34,-84.5,44.7,-76.4,44.7,-76.4Z" transform="translate(100 100)" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section id="announcements" class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h3 class="text-4xl font-black tracking-tight">Latest Announcements</h3>
                    <p class="text-slate-500 font-medium mt-2">Stay updated with campus commerce news</p>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <?php while($ann = $announcements->fetch_assoc()): ?>
                <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm hover:shadow-xl transition-all relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[#13ec25]/5 rounded-bl-full -mr-12 -mt-12 group-hover:bg-[#13ec25]/10 transition-all"></div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-black mb-4 text-[#102212]"><?php echo $ann['title']; ?></h4>
                        <p class="text-slate-500 font-medium leading-relaxed mb-6"><?php echo $ann['content']; ?></p>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?php echo date('M d, Y', strtotime($ann['date'])); ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-20 items-center">
            <div>
                <h3 class="text-4xl font-black tracking-tight mb-8">About INES PRO</h3>
                <div class="space-y-6 text-slate-500 font-medium text-lg leading-relaxed">
                    <p>
                        INES PRO is the premier digital commerce hub for the University of Ines community. We provide a secure and efficient environment for students to exchange goods, services, and innovative ideas.
                    </p>
                    <p>
                        Our mission is to foster a culture of entrepreneurship within the campus, making it easier than ever for student-led businesses to reach their target audience and thrive.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8">
                    <div class="p-6 rounded-3xl bg-[#f6f8f6] border border-slate-100">
                        <p class="text-3xl font-black text-[#13ec25] mb-2">100%</p>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Student Focused</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-[#f6f8f6] border border-slate-100">
                        <p class="text-3xl font-black text-[#facc15] mb-2">Secure</p>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Verified Trading</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://picsum.photos/seed/university/800/600" class="rounded-[40px] shadow-2xl" alt="University Campus">
                <div class="absolute -bottom-10 -left-10 bg-[#13ec25] p-10 rounded-[40px] shadow-xl hidden lg:block">
                    <p class="text-white font-black text-2xl">Join the <br>Revolution.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h3 class="text-4xl font-black tracking-tight">Marketplace Catalog</h3>
                    <p class="text-slate-500 font-medium mt-2">Explore items from our student entrepreneurs</p>
                </div>
                <a href="login.php" class="text-[#13ec25] font-black flex items-center gap-2 hover:gap-4 transition-all">
                    View Full Marketplace <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <?php if($featured_products->num_rows > 0): ?>
                    <?php while($product = $featured_products->fetch_assoc()): ?>
                    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all">
                        <div class="aspect-square relative overflow-hidden">
                            <img src="<?php echo $product['image_url'] ?: 'https://picsum.photos/seed/item/400/400'; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="">
                        </div>
                        <div class="p-6">
                            <p class="text-[10px] font-black text-[#13ec25] uppercase tracking-widest mb-1"><?php echo $product['category']; ?></p>
                            <h4 class="text-lg font-black text-[#102212] mb-4"><?php echo $product['name']; ?></h4>
                            <div class="flex justify-between items-center">
                                <p class="text-xl font-black text-[#102212]"><?php echo number_format($product['price']); ?> RWF</p>
                                <button class="p-3 rounded-xl bg-slate-50 text-slate-400 hover:bg-[#13ec25] hover:text-[#102212] transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-4 py-20 text-center bg-white rounded-[40px] border border-dashed border-slate-200">
                        <p class="text-slate-400 font-black uppercase text-xs tracking-widest">Marketplace is currently being updated</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#102212] text-white py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-[#13ec25] rounded-lg p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#102212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                        </div>
                        <h1 class="text-2xl font-black tracking-tighter">INES<span class="text-[#facc15]">PRO</span></h1>
                    </div>
                    <p class="text-slate-400 max-w-sm font-medium leading-relaxed">
                        The official commerce platform for University of Ines students. Empowering the next generation of Rwandan entrepreneurs.
                    </p>
                </div>
                <div>
                    <h5 class="font-black uppercase text-xs tracking-widest text-white mb-6">Quick Links</h5>
                    <ul class="space-y-4 text-slate-400 font-bold text-sm">
                        <li><a href="#" class="hover:text-[#13ec25] transition-colors">Home</a></li>
                        <li><a href="#about" class="hover:text-[#13ec25] transition-colors">About Us</a></li>
                        <li><a href="#announcements" class="hover:text-[#13ec25] transition-colors">Announcements</a></li>
                        <li><a href="#featured" class="hover:text-[#13ec25] transition-colors">Marketplace</a></li>
                        <li><a href="login.php" class="hover:text-[#13ec25] transition-colors">Admin Portal</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-black uppercase text-xs tracking-widest text-white mb-6">Contact</h5>
                    <ul class="space-y-4 text-slate-400 font-bold text-sm">
                        <li>support@inespro.rw</li>
                        <li>University of Ines, Rwanda</li>
                    </ul>
                </div>
            </div>
            <div class="pt-12 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-slate-500 text-xs font-bold">© 2026 INES PRO. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-500 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                    <a href="#" class="text-slate-500 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                    <a href="#" class="text-slate-500 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
