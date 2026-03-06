<?php
// mvc/views/login_view.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gradient-to-br from-[#102212] to-[#0a1a0b] min-h-screen flex items-center justify-center p-6" style="font-family:'Manrope',sans-serif">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-[40px] p-10 shadow-2xl">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-[#102212] rounded-2xl px-4 py-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#13ec25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    <span class="font-black text-white text-xl">INES<span class="text-[#facc15]">PRO</span></span>
                </div>
                <h2 class="text-2xl font-black text-[#102212]">Welcome Back</h2>
                <p class="text-slate-400 font-medium text-sm mt-1">Sign in to your account</p>
            </div>

            <?php if ($error): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 font-bold text-sm"><?php echo $error; ?></div>
            <?php
endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-[11px] font-black uppercase text-slate-400 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="your@email.com">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase text-slate-400 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-5 py-4 bg-slate-50 rounded-2xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-[#102212] text-white font-black py-4 rounded-2xl hover:bg-[#13ec25] hover:text-[#102212] transition-all shadow-xl shadow-[#102212]/20 mt-2">
                    Sign In →
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center space-y-2">
                <p class="text-slate-500 text-sm">Don't have an account? <a href="signup.php" class="text-[#102212] font-black hover:text-[#13ec25] transition-colors">Sign Up</a></p>
                <a href="index.php" class="text-slate-400 text-xs font-bold hover:text-slate-600 transition-colors">← Back to Home</a>
            </div>

        </div>
    </div>
</body>
</html>
