<?php
// mvc/views/products_view.php - Admin Products Management
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 overflow-y-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">Product Catalog</h2>
            <p class="text-slate-500 font-medium">Manage inventory, product requests & listings</p>
        </div>
    </div>

    <?php if ($success_msg): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $success_msg; ?></div>
    <?php
endif; ?>
    <?php if ($error_msg): ?>
    <div class="bg-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $error_msg; ?></div>
    <?php
endif; ?>

    <!-- Add Product Form -->
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm mb-8">
        <h3 class="text-lg font-black text-[#102212] mb-6">Add New Product</h3>
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Product Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="e.g., INES Hoodie">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Price (RWF) *</label>
                <input type="number" name="price" required min="1" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="5000">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Category *</label>
                <input type="text" name="category" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="Electronics">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Stock Quantity *</label>
                <input type="number" name="stock" required min="0" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="10">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Description</label>
                <input type="text" name="description" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="Brief product description...">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Upload Image</label>
                <input type="file" name="product_image" accept="image/*" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-2 border-dashed border-slate-200 cursor-pointer hover:border-[#13ec25] transition-colors">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Or Image URL</label>
                <input type="url" name="image_url" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold border-none focus:ring-2 focus:ring-[#13ec25]/50 outline-none" placeholder="https://...">
            </div>
            <div class="lg:col-span-3">
                <button type="submit" name="add_product" class="bg-[#13ec25] text-[#102212] font-black px-8 py-3 rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-[#13ec25]/20">
                    + Add Product
                </button>
            </div>
        </form>
    </div>

    <!-- Pending Product Requests -->
    <?php if ($requests->num_rows > 0): ?>
    <div class="bg-white rounded-3xl p-8 border border-orange-100 shadow-sm mb-8">
        <h3 class="text-lg font-black text-[#102212] mb-6">📬 Pending Product Requests</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] text-slate-400 uppercase tracking-widest font-black border-b border-slate-100">
                        <th class="pb-4 pr-6">Product</th>
                        <th class="pb-4 pr-6">Submitted By</th>
                        <th class="pb-4 pr-6">Price</th>
                        <th class="pb-4 pr-6">Category</th>
                        <th class="pb-4 pr-6">Status</th>
                        <th class="pb-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php while ($req = $requests->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-4 pr-6">
                            <div class="flex items-center gap-3">
                                <?php if ($req['image_path']): ?>
                                <img src="<?php echo $req['image_path']; ?>" class="w-12 h-12 object-cover rounded-xl" alt="">
                                <?php
        else: ?>
                                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 text-xs font-black">IMG</div>
                                <?php
        endif; ?>
                                <div>
                                    <p class="font-black text-sm text-[#102212]"><?php echo $req['product_name']; ?></p>
                                    <p class="text-[10px] text-slate-400 font-bold max-w-[200px] truncate"><?php echo $req['description']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 pr-6">
                            <div class="flex items-center gap-2">
                                <img src="<?php echo $req['avatar_url'] ?: 'https://i.pravatar.cc/40'; ?>" class="w-7 h-7 rounded-full object-cover" alt="">
                                <span class="text-sm font-bold text-[#102212]"><?php echo $req['user_name']; ?></span>
                            </div>
                        </td>
                        <td class="py-4 pr-6 font-black text-sm"><?php echo number_format($req['price']); ?> RWF</td>
                        <td class="py-4 pr-6"><span class="px-2 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg uppercase"><?php echo $req['category']; ?></span></td>
                        <td class="py-4 pr-6">
                            <span class="px-2 py-1 text-[10px] font-black rounded-lg uppercase
                            <?php echo $req['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-700' : ($req['status'] == 'Approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                                <?php echo $req['status']; ?>
                            </span>
                        </td>
                        <td class="py-4">
                            <?php if ($req['status'] == 'Pending'): ?>
                            <div class="flex gap-2">
                                <a href="?approve_req=<?php echo $req['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase hover:bg-green-200 transition-colors">✓ Approve</a>
                                <a href="?reject_req=<?php echo $req['id']; ?>" class="px-3 py-1.5 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-200 transition-colors">✗ Reject</a>
                            </div>
                            <?php
        endif; ?>
                        </td>
                    </tr>
                    <?php
    endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
endif; ?>

    <!-- Products Grid -->
    <h3 class="text-lg font-black text-[#102212] mb-4">All Products</h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($product = $products->fetch_assoc()):
    $imgSrc = $product['image_path'] ? $product['image_path'] : ($product['image_url'] ?: 'https://picsum.photos/seed/prod/400/300');
?>
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="aspect-video relative overflow-hidden">
                <img src="<?php echo $imgSrc; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo $product['name']; ?>">
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 text-[9px] font-black uppercase rounded-lg bg-white/90 backdrop-blur <?php echo $product['status'] == 'Published' ? 'text-green-600' : 'text-slate-500'; ?>">
                        <?php echo $product['status']; ?>
                    </span>
                </div>
            </div>
            <div class="p-5">
                <p class="text-[10px] font-black text-[#13ec25] uppercase tracking-widest mb-1"><?php echo $product['category']; ?></p>
                <h4 class="font-black text-[#102212] mb-1"><?php echo $product['name']; ?></h4>
                <div class="flex justify-between items-center mt-3">
                    <p class="text-xl font-black text-[#102212]"><?php echo number_format($product['price']); ?> RWF</p>
                    <span class="text-[10px] uppercase text-slate-400 font-bold"><?php echo $product['stock_quantity']; ?> units</span>
                </div>
                <?php if ($product['seller_name']): ?>
                <p class="text-[10px] text-slate-400 font-bold mt-1">By: <?php echo $product['seller_name']; ?></p>
                <?php
    endif; ?>
                <div class="flex gap-2 mt-4">
                    <a href="?toggle_id=<?php echo $product['id']; ?>" class="flex-1 py-2 text-center text-[10px] font-black uppercase rounded-xl bg-slate-100 text-slate-500 hover:bg-[#13ec25] hover:text-[#102212] transition-all">
                        <?php echo $product['status'] == 'Published' ? 'Unpublish' : 'Publish'; ?>
                    </a>
                    <a href="?delete_id=<?php echo $product['id']; ?>" onclick="return confirm('Delete this product?')" class="py-2 px-4 text-[10px] font-black uppercase rounded-xl bg-red-100 text-red-600 hover:bg-red-500 hover:text-white transition-all">
                        Delete
                    </a>
                </div>
            </div>
        </div>
        <?php
endwhile; ?>
    </div>
</main>
</body>
</html>
