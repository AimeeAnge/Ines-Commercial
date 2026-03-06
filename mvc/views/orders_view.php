<?php
// mvc/views/orders_view.php - Admin Orders Management
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 overflow-y-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">Orders Management</h2>
            <p class="text-slate-500 font-medium">Review and approve student purchase orders</p>
        </div>
    </div>

    <?php if ($success_msg): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $success_msg; ?></div>
    <?php
endif; ?>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50">
            <h3 class="font-black text-[#102212]">All Orders</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Order #</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Customer</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Total</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Date</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if ($orders->num_rows > 0):
    while ($order = $orders->fetch_assoc()):
        $statusColors = [
            'Pending' => 'bg-yellow-100 text-yellow-700',
            'Approved' => 'bg-green-100 text-green-700',
            'Rejected' => 'bg-red-100 text-red-700'
        ];
        $sc = $statusColors[$order['status']] ?? 'bg-slate-100 text-slate-500';
?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-black text-[#102212]">#<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="<?php echo $order['avatar_url'] ?: 'https://i.pravatar.cc/40'; ?>" class="w-9 h-9 rounded-full object-cover" alt="">
                                <div>
                                    <p class="font-black text-sm text-[#102212]"><?php echo $order['user_name']; ?></p>
                                    <p class="text-[10px] text-slate-400 font-bold"><?php echo $order['email']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-black text-[#102212]"><?php echo number_format($order['total_price']); ?> RWF</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-[10px] font-black rounded-xl uppercase tracking-widest <?php echo $sc; ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-400"><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <?php if ($order['status'] == 'Pending'): ?>
                                <a href="?approve_order=<?php echo $order['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase hover:bg-green-200 transition-colors">✓ Approve</a>
                                <a href="?reject_order=<?php echo $order['id']; ?>" class="px-3 py-1.5 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-200 transition-colors">✗ Reject</a>
                                <?php
        else: ?>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Processed</span>
                                <?php
        endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php
    endwhile;
else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="text-4xl mb-3">🛒</div>
                            <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">No orders yet</p>
                        </td>
                    </tr>
                    <?php
endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
