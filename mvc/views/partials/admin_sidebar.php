<?php
// mvc/views/partials/admin_sidebar.php
$current = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-64 bg-[#102212] text-white flex flex-col h-screen sticky top-0 shrink-0">
    <div class="p-6 flex items-center gap-3 border-b border-white/10">
        <div class="bg-[#13ec25] rounded-lg p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#102212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
        </div>
        <div>
            <h1 class="text-xl font-black tracking-tighter">INES<span class="text-[#facc15]">PRO</span></h1>
            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Admin Panel</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <?php
$navItems = [
    ['dashboard.php', 'Dashboard', '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
    ['products.php', 'Products', '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>'],
    ['orders.php', 'Orders', '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>'],
    ['users.php', 'Users', '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
    ['messages.php', 'Messages', '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'],
    ['announcements.php', 'Announcements', '<path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/>'],
];
foreach ($navItems as [$href, $label, $path]):
    $isActive = $current === $href;
?>
        <a href="<?php echo $href; ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo $isActive ? 'bg-[#13ec25] text-[#102212]' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $path; ?></svg>
            <span><?php echo $label; ?></span>
        </a>
        <?php
endforeach; ?>
    </nav>

    <div class="p-4 border-t border-white/10">
        <a href="index.php" class="flex items-center gap-3 px-4 py-2 rounded-xl text-slate-400 hover:text-white text-sm font-bold transition-all mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="m16 12-4-4-4 4M12 8v8"/></svg>
            View Site
        </a>
        <a href="logout.php" class="flex items-center gap-3 px-4 py-2 rounded-xl text-red-400 hover:bg-red-400/10 text-sm font-bold transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
            Logout
        </a>
    </div>
</aside>
