<?php
// mvc/views/users_view.php - Admin User Management
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 overflow-y-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">User Management</h2>
            <p class="text-slate-500 font-medium">Manage platform users, roles & access</p>
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

    <!-- Add User Form -->
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm mb-8">
        <h3 class="text-lg font-black text-[#102212] mb-6">Create New User</h3>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Full Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="John Doe">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Email *</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="john@ines.com">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Password *</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="••••••••">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Role *</label>
                <select name="role" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50">
                    <option value="Student">Student</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div>
                <button type="submit" name="add_user" class="w-full bg-[#102212] text-white font-black py-3 px-6 rounded-xl hover:bg-[#13ec25] hover:text-[#102212] transition-all">
                    + Create User
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-black text-[#102212]">All Users</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">User</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Role</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Joined</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php while ($user = $users->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="<?php echo $user['avatar_url'] ?: 'https://i.pravatar.cc/40?u=' . $user['id']; ?>" class="w-11 h-11 rounded-full object-cover border-2 border-[#13ec25]/20" alt="">
                                <div>
                                    <p class="font-black text-sm text-[#102212]"><?php echo $user['name']; ?></p>
                                    <p class="text-xs text-slate-400 font-bold"><?php echo $user['email']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" class="flex items-center gap-2">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <select name="new_role" class="text-[11px] font-black bg-slate-100 rounded-lg px-2 py-1 outline-none border-none cursor-pointer">
                                    <?php foreach (['Student', 'Admin'] as $roleOpt): ?>
                                    <option value="<?php echo $roleOpt; ?>" <?php echo $user['role'] == $roleOpt ? 'selected' : ''; ?>><?php echo $roleOpt; ?></option>
                                    <?php
    endforeach; ?>
                                </select>
                                <button type="submit" name="change_role" class="text-[9px] font-black text-[#13ec25] hover:underline uppercase">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full <?php echo $user['status'] == 'Active' ? 'bg-green-400' : 'bg-slate-300'; ?>"></div>
                                <span class="text-xs font-black uppercase tracking-widest text-slate-600"><?php echo $user['status']; ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-400"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <?php if ($user['status'] == 'Active'): ?>
                                <a href="?suspend_id=<?php echo $user['id']; ?>" class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-[10px] font-black rounded-lg uppercase hover:bg-yellow-200 transition-colors">Suspend</a>
                                <?php
    else: ?>
                                <a href="?activate_id=<?php echo $user['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase hover:bg-green-200 transition-colors">Activate</a>
                                <?php
    endif; ?>
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="?delete_id=<?php echo $user['id']; ?>" onclick="return confirm('Delete user <?php echo $user['name']; ?>?')" class="px-3 py-1.5 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-200 transition-colors">Delete</a>
                                <?php
    endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php
endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
