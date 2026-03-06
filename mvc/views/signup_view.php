<?php
// mvc/views/signup_view.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gradient-to-br from-[#102212] to-[#0a1a0b] min-h-screen flex items-center justify-center p-6" style="font-family:'Manrope',sans-serif">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-[40px] p-10 shadow-2xl">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-[#102212] rounded-2xl px-4 py-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#13ec25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    <span class="font-black text-white text-xl">INES<span class="text-[#facc15]">PRO</span></span>
                </div>
                <h2 class="text-2xl font-black text-[#102212]">Create Account</h2>
                <p class="text-slate-400 font-medium text-sm mt-1">Join the INES student marketplace</p>
            </div>

            <?php if (!empty($error)): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 font-bold text-sm"><?php echo $error; ?></div>
            <?php
endif; ?>
            <?php if (!empty($success)): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl mb-6 font-bold text-sm">
                <?php echo $success; ?> <a href="login.php" class="underline font-black">Login here</a>
            </div>
            <?php
endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-[11px] font-black uppercase text-slate-400 mb-2">Full Name</label>
                    <input type="text" name="name" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="Your full name">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase text-slate-400 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="your@email.com">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase text-slate-400 mb-2">Password</label>
                    <input type="password" name="password" required minlength="6" class="w-full px-5 py-4 bg-slate-50 rounded-2xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="Minimum 6 characters">
                </div>
                <button type="submit" class="w-full bg-[#13ec25] text-[#102212] font-black py-4 rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-[#13ec25]/20">
                    Create Account →
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-sm">Already have an account? <a href="login.php" class="text-[#102212] font-black hover:text-[#13ec25] transition-colors">Sign In</a></p>
                <a href="index.php" class="text-slate-400 text-xs font-bold hover:text-slate-600 transition-colors mt-2 inline-block">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
