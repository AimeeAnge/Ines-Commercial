<?php
// mvc/views/messages_view.php - Admin Messages & Chat
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 overflow-y-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">Messages & Requests</h2>
            <p class="text-slate-500 font-medium">All student communications and product requests</p>
        </div>
    </div>

    <?php if (isset($success_msg) && $success_msg): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm"><?php echo $success_msg; ?></div>
    <?php
endif; ?>

    <div class="space-y-5">
        <?php if ($messages->num_rows > 0):
    while ($msg = $messages->fetch_assoc()): ?>
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:border-[#13ec25]/30 transition-all">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <img src="<?php echo $msg['sender_avatar'] ?: 'https://i.pravatar.cc/48?u=' . $msg['sender_id']; ?>" class="w-12 h-12 rounded-2xl object-cover border-2 border-[#13ec25]/20 shrink-0" alt="">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <h4 class="font-black text-[#102212]"><?php echo $msg['sender_name'] ?: 'Anonymous'; ?></h4>
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded-full tracking-widest <?php echo $msg['type'] == 'Request' ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600'; ?>">
                                <?php echo $msg['type']; ?>
                            </span>
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded-full tracking-widest <?php echo $msg['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600'; ?>">
                                <?php echo $msg['status']; ?>
                            </span>
                        </div>
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest"><?php echo $msg['subject']; ?></p>
                    </div>
                </div>
                <div class="text-right shrink-0">
                    <p class="text-[10px] font-bold text-slate-400 mb-3"><?php echo date('M d, Y H:i', strtotime($msg['timestamp'])); ?></p>
                    <div class="flex gap-2 justify-end">
                        <?php if ($msg['type'] == 'Request' && $msg['status'] == 'Pending'): ?>
                        <a href="?action=approve&id=<?php echo $msg['id']; ?>" class="px-3 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-xl uppercase hover:bg-green-200 transition-colors">✓ Approve</a>
                        <?php
        endif; ?>
                        <a href="?action=read&id=<?php echo $msg['id']; ?>" class="px-3 py-1.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-xl uppercase hover:bg-slate-200 transition-colors">Read</a>
                        <a href="?action=archive&id=<?php echo $msg['id']; ?>" onclick="return confirm('Delete this message?')" class="px-3 py-1.5 bg-red-50 text-red-500 text-[10px] font-black rounded-xl uppercase hover:bg-red-100 transition-colors">Delete</a>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-slate-50 rounded-2xl p-4">
                <p class="text-sm text-slate-600 font-medium leading-relaxed"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></p>
            </div>

            <?php if ($msg['sender_id'] != $_SESSION['user_id']): ?>
            <form method="POST" class="mt-4 flex gap-3">
                <input type="hidden" name="receiver_id" value="<?php echo $msg['sender_id']; ?>">
                <input type="hidden" name="original_subject" value="<?php echo htmlspecialchars($msg['subject']); ?>">
                <input type="text" name="reply_content" required class="flex-1 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="Reply to this message...">
                <button type="submit" name="send_reply" class="bg-[#102212] text-white px-6 py-3 rounded-xl font-black text-sm hover:bg-[#13ec25] hover:text-[#102212] transition-all whitespace-nowrap">
                    Send Reply
                </button>
            </form>
            <?php
        endif; ?>
        </div>
        <?php
    endwhile;
else: ?>
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
            <div class="text-5xl mb-4">💬</div>
            <p class="text-slate-400 font-black text-xs uppercase tracking-widest">No messages or requests</p>
        </div>
        <?php
endif; ?>
    </div>
</main>
</body>
</html>
