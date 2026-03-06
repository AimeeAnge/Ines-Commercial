<?php
// mvc/views/dashboard_view.php - Admin Dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 overflow-y-auto p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">Admin Dashboard</h2>
            <p class="text-slate-500 font-medium mt-1">Welcome back, <span class="text-[#13ec25] font-black"><?php echo $_SESSION['user_name']; ?></span></p>
        </div>
        <div class="flex items-center gap-4">
            <img src="<?php echo $_SESSION['user_avatar'] ?: 'https://i.pravatar.cc/150?u=admin'; ?>" class="w-12 h-12 rounded-full border-4 border-[#13ec25]/30 object-cover" alt="">
            <div>
                <p class="font-black text-sm text-[#102212]"><?php echo $_SESSION['user_name']; ?></p>
                <span class="text-[10px] font-black uppercase tracking-widest text-[#13ec25]"><?php echo $_SESSION['user_role']; ?></span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <p class="text-3xl font-black text-[#102212]"><?php echo $stats['userCount']; ?></p>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Users</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
            </div>
            <p class="text-3xl font-black text-[#102212]"><?php echo $stats['productCount']; ?></p>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Products</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#eab308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            </div>
            <p class="text-3xl font-black text-orange-500"><?php echo $stats['pendingOrders']; ?></p>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Pending Orders</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <p class="text-3xl font-black text-blue-500"><?php echo $stats['messageCount']; ?></p>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Messages</p>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12h6"/><path d="M12 9v6"/><circle cx="12" cy="12" r="10"/></svg>
            </div>
            <p class="text-3xl font-black text-red-500"><?php echo $stats['pendingRequests']; ?></p>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Product Req.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Pending Orders -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-black text-[#102212]">Pending Orders</h3>
                <a href="orders.php" class="text-xs font-black text-[#13ec25] uppercase tracking-widest hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                <?php if ($pendingOrders->num_rows > 0):
    while ($order = $pendingOrders->fetch_assoc()): ?>
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <img src="<?php echo $order['avatar_url'] ?: 'https://i.pravatar.cc/40'; ?>" class="w-9 h-9 rounded-xl object-cover" alt="">
                        <div>
                            <p class="font-black text-sm text-[#102212]"><?php echo $order['user_name']; ?></p>
                            <p class="text-[10px] text-slate-400 font-bold"><?php echo number_format($order['total_price']); ?> RWF</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="orders.php?approve_order=<?php echo $order['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase hover:bg-green-200 transition-colors">Approve</a>
                        <a href="orders.php?reject_order=<?php echo $order['id']; ?>" class="px-3 py-1.5 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-200 transition-colors">Reject</a>
                    </div>
                </div>
                <?php
    endwhile;
else: ?>
                <div class="py-10 text-center">
                    <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">No pending orders</p>
                </div>
                <?php
endif; ?>
            </div>
        </div>

        <!-- Pending Product Requests -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-black text-[#102212]">Product Requests</h3>
                <a href="products.php" class="text-xs font-black text-[#13ec25] uppercase tracking-widest hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                <?php if ($pendingProductReqs->num_rows > 0):
    while ($req = $pendingProductReqs->fetch_assoc()): ?>
                <div class="flex items-center justify-between p-4 bg-orange-50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                            <?php if ($req['image_path']): ?>
                            <img src="<?php echo $req['image_path']; ?>" class="w-10 h-10 rounded-xl object-cover" alt="">
                            <?php
        else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="#f97316" stroke-width="2" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                            <?php
        endif; ?>
                        </div>
                        <div>
                            <p class="font-black text-sm text-[#102212]"><?php echo $req['product_name']; ?></p>
                            <p class="text-[10px] text-slate-400 font-bold">By: <?php echo $req['user_name']; ?> · <?php echo number_format($req['price']); ?> RWF</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="products.php?approve_req=<?php echo $req['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase hover:bg-green-200 transition-colors">Approve</a>
                        <a href="products.php?reject_req=<?php echo $req['id']; ?>" class="px-3 py-1.5 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-200 transition-colors">Reject</a>
                    </div>
                </div>
                <?php
    endwhile;
else: ?>
                <div class="py-10 text-center">
                    <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">No pending product requests</p>
                </div>
                <?php
endif; ?>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm lg:col-span-2">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-black text-[#102212]">Recent Requests</h3>
                <a href="messages.php" class="text-xs font-black text-[#13ec25] uppercase tracking-widest hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                <?php
$recentRequests->data_seek(0);
if ($recentRequests->num_rows > 0):
    while ($req = $recentRequests->fetch_assoc()): ?>
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-black text-xs">RQ</div>
                        <div>
                            <p class="text-sm font-black text-[#102212]"><?php echo $req['subject']; ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">From: <?php echo $req['sender_name']; ?></p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest <?php echo $req['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600'; ?>">
                        <?php echo $req['status']; ?>
                    </span>
                </div>
                <?php
    endwhile;
else: ?>
                <p class="text-center py-6 text-slate-400 font-black text-[10px] uppercase tracking-widest">No recent requests</p>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
