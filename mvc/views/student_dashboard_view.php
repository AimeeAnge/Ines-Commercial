<?php
// mvc/views/student_dashboard_view.php - Student/User Dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | My Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen" style="font-family:'Manrope',sans-serif">

<!-- Student Top Nav -->
<nav class="bg-[#102212] text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="index.php" class="flex items-center gap-2">
            <div class="bg-[#13ec25] rounded-lg p-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#102212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
            </div>
            <span class="font-black text-xl">INES<span class="text-[#facc15]">PRO</span></span>
        </a>

        <div class="flex items-center gap-4">
            <?php if ($cartCount > 0): ?>
            <span class="relative inline-block">
                <a href="#cart-section" class="flex items-center gap-1.5 bg-[#13ec25] text-[#102212] font-black px-4 py-2 rounded-xl text-sm hover:scale-105 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                    Cart (<?php echo $cartCount; ?>)
                </a>
            </span>
            <?php
endif; ?>
            <div class="flex items-center gap-2">
                <img src="<?php echo $_SESSION['user_avatar'] ?: 'https://i.pravatar.cc/40'; ?>" class="w-8 h-8 rounded-full object-cover border-2 border-[#13ec25]/30" alt="">
                <span class="font-black text-sm"><?php echo $_SESSION['user_name']; ?></span>
            </div>
            <a href="logout.php" class="text-red-400 hover:text-red-300 font-bold text-sm transition-colors">Logout</a>
        </div>
    </div>

    <!-- Tab Bar -->
    <div class="max-w-7xl mx-auto px-6 flex gap-1 pb-0 border-t border-white/10">
        <?php
$activeTab = $_GET['tab'] ?? 'shop';
$tabs = [
    'shop' => '🛍️ Shop',
    'cart' => '🛒 My Cart',
    'orders' => '📦 My Orders',
    'chat' => '💬 Chat Admin',
    'request' => '📤 Request Product',
];
foreach ($tabs as $tabKey => $tabLabel): ?>
        <a href="?tab=<?php echo $tabKey; ?>" class="px-4 py-3 text-sm font-black transition-all <?php echo $activeTab == $tabKey ? 'text-[#13ec25] border-b-2 border-[#13ec25]' : 'text-slate-400 hover:text-white'; ?>">
            <?php echo $tabLabel; ?>
        </a>
        <?php
endforeach; ?>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">
    <?php if ($success_msg): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $success_msg; ?></div>
    <?php
endif; ?>
    <?php if ($error_msg): ?>
    <div class="bg-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $error_msg; ?></div>
    <?php
endif; ?>

    <!-- SHOP TAB -->
    <?php if ($activeTab == 'shop'): ?>
    <div class="mb-6">
        <h2 class="text-2xl font-black text-[#102212] mb-2">Marketplace</h2>
        <p class="text-slate-500 font-medium">Browse and add items to your cart</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($products as $product):
        $imgSrc = $product['image_path'] ? $product['image_path'] : ($product['image_url'] ?: 'https://picsum.photos/seed/item' . $product['id'] . '/400/400');
?>
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="aspect-square overflow-hidden">
                <img src="<?php echo $imgSrc; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="p-5">
                <p class="text-[10px] font-black text-[#13ec25] uppercase tracking-widest mb-1"><?php echo $product['category']; ?></p>
                <h3 class="font-black text-[#102212] mb-1 truncate"><?php echo $product['name']; ?></h3>
                <p class="text-xs text-slate-400 font-medium mb-3 line-clamp-2"><?php echo $product['description']; ?></p>
                <div class="flex justify-between items-center mb-4">
                    <p class="text-xl font-black text-[#102212]"><?php echo number_format($product['price']); ?> <span class="text-xs font-bold text-slate-400">RWF</span></p>
                    <span class="text-[10px] font-black text-slate-400 uppercase"><?php echo $product['stock_quantity']; ?> left</span>
                </div>
                <form method="POST" action="?tab=cart">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" name="add_to_cart" class="w-full bg-[#102212] text-white font-black py-3 rounded-2xl hover:bg-[#13ec25] hover:text-[#102212] transition-all text-sm">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        <?php
    endforeach; ?>
        <?php if (empty($products)): ?>
        <div class="col-span-4 py-16 text-center bg-white rounded-3xl border border-dashed border-slate-200">
            <p class="text-slate-400 font-black text-xs uppercase tracking-widest">No products available yet</p>
        </div>
        <?php
    endif; ?>
    </div>

    <!-- CART TAB -->
    <?php
elseif ($activeTab == 'cart'): ?>
    <div id="cart-section">
        <h2 class="text-2xl font-black text-[#102212] mb-2">Your Cart</h2>
        <p class="text-slate-500 font-medium mb-6">Review items and place your order for admin approval</p>

        <?php if ($cartItems->num_rows > 0): ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <?php while ($item = $cartItems->fetch_assoc()):
            $imgSrc = $item['image_path'] ? $item['image_path'] : ($item['image_url'] ?: 'https://picsum.photos/seed/item/80/80');
?>
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4">
                    <img src="<?php echo $imgSrc; ?>" class="w-16 h-16 rounded-xl object-cover" alt="">
                    <div class="flex-1">
                        <p class="font-black text-[#102212]"><?php echo $item['name']; ?></p>
                        <p class="text-[10px] font-black text-[#13ec25] uppercase tracking-widest"><?php echo $item['category']; ?></p>
                        <p class="text-sm font-black text-slate-500 mt-1">Qty: <?php echo $item['quantity']; ?> × <?php echo number_format($item['price']); ?> RWF</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-[#102212]"><?php echo number_format($item['price'] * $item['quantity']); ?> RWF</p>
                        <a href="?tab=cart&remove_cart=<?php echo $item['id']; ?>" class="text-[10px] text-red-400 hover:text-red-600 font-black uppercase mt-1 inline-block transition-colors">Remove</a>
                    </div>
                </div>
                <?php
        endwhile; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm sticky top-24">
                    <h3 class="font-black text-[#102212] mb-4">Order Summary</h3>
                    <div class="flex justify-between items-center py-3 border-b border-slate-100">
                        <span class="text-sm font-bold text-slate-500">Subtotal</span>
                        <span class="font-black text-[#102212]"><?php echo number_format($cartTotal); ?> RWF</span>
                    </div>
                    <div class="flex justify-between items-center py-3 mb-4">
                        <span class="font-black text-[#102212]">Total</span>
                        <span class="text-xl font-black text-[#13ec25]"><?php echo number_format($cartTotal); ?> RWF</span>
                    </div>
                    <form method="POST">
                        <textarea name="notes" class="w-full bg-slate-50 rounded-xl px-4 py-3 text-sm font-bold outline-none mb-4 resize-none" rows="3" placeholder="Special notes for admin (optional)..."></textarea>
                        <button type="submit" name="place_order" class="w-full bg-[#13ec25] text-[#102212] font-black py-4 rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-[#13ec25]/20">
                            🚀 Place Order (Send to Admin)
                        </button>
                    </form>
                    <p class="text-[10px] text-slate-400 font-bold text-center mt-3 uppercase tracking-widest">Admin will approve your order</p>
                </div>
            </div>
        </div>
        <?php
    else: ?>
        <div class="py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
            <div class="text-5xl mb-4">🛒</div>
            <p class="text-slate-400 font-black text-xs uppercase tracking-widest mb-4">Your cart is empty</p>
            <a href="?tab=shop" class="bg-[#13ec25] text-[#102212] font-black px-6 py-3 rounded-xl hover:scale-105 transition-all inline-block">Browse Products</a>
        </div>
        <?php
    endif; ?>
    </div>

    <!-- MY ORDERS TAB -->
    <?php
elseif ($activeTab == 'orders'): ?>
    <h2 class="text-2xl font-black text-[#102212] mb-2">My Orders</h2>
    <p class="text-slate-500 font-medium mb-6">Track your order history and approval status</p>

    <div class="space-y-4">
        <?php if ($myOrders->num_rows > 0):
        while ($order = $myOrders->fetch_assoc()):
            $colors = ['Pending' => 'bg-yellow-100 text-yellow-700', 'Approved' => 'bg-green-100 text-green-700', 'Rejected' => 'bg-red-100 text-red-700'];
            $sc = $colors[$order['status']] ?? 'bg-slate-100 text-slate-500';
?>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-black text-[#102212]">Order #<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></p>
                    <p class="text-xs text-slate-400 font-bold"><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></p>
                    <?php if ($order['notes']): ?>
                    <p class="text-xs text-slate-500 font-medium mt-1">Note: <?php echo $order['notes']; ?></p>
                    <?php
            endif; ?>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-black text-[#102212]"><?php echo number_format($order['total_price']); ?> RWF</p>
                    <span class="px-3 py-1 text-[10px] font-black rounded-xl uppercase tracking-widest <?php echo $sc; ?>">
                        <?php echo $order['status']; ?>
                    </span>
                </div>
            </div>
        </div>
        <?php
        endwhile;
    else: ?>
        <div class="py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
            <div class="text-5xl mb-4">📦</div>
            <p class="text-slate-400 font-black text-xs uppercase tracking-widest mb-4">No orders yet</p>
            <a href="?tab=shop" class="bg-[#13ec25] text-[#102212] font-black px-6 py-3 rounded-xl hover:scale-105 transition-all inline-block">Start Shopping</a>
        </div>
        <?php
    endif; ?>
    </div>

    <!-- CHAT ADMIN TAB -->
    <?php
elseif ($activeTab == 'chat'): ?>
    <h2 class="text-2xl font-black text-[#102212] mb-2">Chat with Admin</h2>
    <p class="text-slate-500 font-medium mb-6">Send messages and requests directly to admin</p>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Send Message Form -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h3 class="font-black text-[#102212] mb-6">Send New Message</h3>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Message Type</label>
                    <select name="type" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50">
                        <option value="Message">General Message</option>
                        <option value="Request">Product Request Inquiry</option>
                        <option value="AnnouncementRequest">Post an Announcement Request</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Subject *</label>
                    <input type="text" name="subject" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="e.g., Question about delivery">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Message *</label>
                    <textarea name="content" required rows="5" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50 resize-none" placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" name="send_message" class="w-full bg-[#102212] text-white font-black py-4 rounded-2xl hover:bg-[#13ec25] hover:text-[#102212] transition-all">
                    Send Message
                </button>
            </form>
        </div>

        <!-- Chat History -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h3 class="font-black text-[#102212] mb-6">Conversation History</h3>
            <div class="space-y-4 max-h-[500px] overflow-y-auto">
                <?php if ($chatMessages->num_rows > 0):
        while ($msg = $chatMessages->fetch_assoc()):
            $isMe = $msg['sender_id'] == $_SESSION['user_id'];
?>
                <div class="flex <?php echo $isMe ? 'justify-end' : 'justify-start'; ?>">
                    <div class="max-w-[80%] <?php echo $isMe ? 'bg-[#13ec25] text-[#102212]' : 'bg-slate-100 text-[#102212]'; ?> rounded-2xl px-4 py-3">
                        <p class="text-[9px] font-black uppercase tracking-widest mb-1 <?php echo $isMe ? 'text-[#102212]/60' : 'text-slate-400'; ?>">
                            <?php echo $isMe ? 'You' : 'Admin'; ?> · <?php echo date('M d, H:i', strtotime($msg['timestamp'])); ?>
                        </p>
                        <p class="text-sm font-bold"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></p>
                        <?php if ($msg['subject']): ?>
                        <p class="text-[10px] mt-1 opacity-60 font-black uppercase"><?php echo $msg['subject']; ?></p>
                        <?php
            endif; ?>
                    </div>
                </div>
                <?php
        endwhile;
    else: ?>
                <div class="py-10 text-center">
                    <div class="text-4xl mb-3">💬</div>
                    <p class="text-slate-400 font-black text-xs uppercase tracking-widest">No messages yet. Start a conversation!</p>
                </div>
                <?php
    endif; ?>
            </div>
        </div>
    </div>

    <!-- REQUEST PRODUCT TAB -->
    <?php
elseif ($activeTab == 'request'): ?>
    <h2 class="text-2xl font-black text-[#102212] mb-2">Request to List Your Product</h2>
    <p class="text-slate-500 font-medium mb-6">Submit your product for admin review and approval</p>

    <div class="grid lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h3 class="font-black text-[#102212] mb-6">Product Details</h3>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Product Name *</label>
                    <input type="text" name="product_name" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="e.g., My Handmade Crafts">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Price (RWF) *</label>
                        <input type="number" name="price" required min="1" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="5000">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Category *</label>
                        <input type="text" name="category" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="Handmade">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50 resize-none" placeholder="Describe your product in detail..."></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Product Image</label>
                    <input type="file" name="product_image" accept="image/*" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-2 border-dashed border-slate-200 cursor-pointer hover:border-[#13ec25] transition-colors">
                </div>
                <button type="submit" name="submit_request" class="w-full bg-[#102212] text-white font-black py-4 rounded-2xl hover:bg-[#13ec25] hover:text-[#102212] transition-all shadow-lg">
                    📤 Submit for Admin Approval
                </button>
            </form>
        </div>

        <!-- My Requests Status -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h3 class="font-black text-[#102212] mb-6">My Product Requests</h3>
            <div class="space-y-4">
                <?php if ($myRequests->num_rows > 0):
        while ($req = $myRequests->fetch_assoc()):
            $colors = ['Pending' => 'bg-yellow-100 text-yellow-700', 'Approved' => 'bg-green-100 text-green-700', 'Rejected' => 'bg-red-100 text-red-700'];
            $sc = $colors[$req['status']] ?? 'bg-slate-100 text-slate-500';
?>
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="flex items-center gap-3">
                        <?php if ($req['image_path']): ?>
                        <img src="<?php echo $req['image_path']; ?>" class="w-12 h-12 rounded-xl object-cover" alt="">
                        <?php
            else: ?>
                        <div class="w-12 h-12 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400 font-black text-xs">IMG</div>
                        <?php
            endif; ?>
                        <div class="flex-1">
                            <p class="font-black text-[#102212] text-sm"><?php echo $req['product_name']; ?></p>
                            <p class="text-[10px] text-slate-400 font-bold"><?php echo number_format($req['price']); ?> RWF · <?php echo $req['category']; ?></p>
                        </div>
                        <span class="px-2 py-1 text-[9px] font-black rounded-lg uppercase <?php echo $sc; ?>">
                            <?php echo $req['status']; ?>
                        </span>
                    </div>
                    <?php if ($req['admin_note']): ?>
                    <p class="text-xs text-slate-500 font-medium mt-2 pl-1">Admin note: <?php echo $req['admin_note']; ?></p>
                    <?php
            endif; ?>
                </div>
                <?php
        endwhile;
    else: ?>
                <div class="py-10 text-center">
                    <p class="text-slate-400 font-black text-xs uppercase tracking-widest">No requests submitted yet</p>
                </div>
                <?php
    endif; ?>
            </div>
        </div>
    </div>
    <?php
endif; ?>
</div>
</body>
</html>
