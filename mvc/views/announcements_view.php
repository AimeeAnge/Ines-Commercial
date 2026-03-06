<?php
// mvc/views/announcements_view.php - Admin Announcements Management
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INES PRO | Announcements</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#f0f2f5] min-h-screen flex" style="font-family:'Manrope',sans-serif">

<?php include __DIR__ . '/partials/admin_sidebar.php'; ?>

<main class="flex-1 p-8 overflow-y-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-[#102212]">Announcements</h2>
            <p class="text-slate-500 font-medium">Manage public announcements and review student requests</p>
        </div>
    </div>

    <?php if ($success_msg): ?>
        <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-2xl mb-6 font-bold text-sm">
            <?php echo $success_msg; ?>
        </div>
    <?php
endif; ?>

    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Create Announcement Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm sticky top-6">
                <h3 class="text-xl font-black text-[#102212] mb-4">Post New Announcement</h3>
                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Title *</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50" placeholder="Announcement title">
                    </div>
                    <div class="mb-6">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Content *</label>
                        <textarea name="content" required rows="5" class="w-full px-4 py-3 bg-slate-50 rounded-xl text-sm font-bold outline-none focus:ring-2 focus:ring-[#13ec25]/50 resize-none" placeholder="Announcement body..."></textarea>
                    </div>
                    <button type="submit" name="create_announcement" class="w-full bg-[#102212] text-white font-black py-4 rounded-2xl hover:bg-[#13ec25] hover:text-[#102212] transition-colors shadow-lg">
                        Post Announcement
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            
            <!-- Pending Requests from Students -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-[#102212]">Pending Announcement Requests</h3>
                    <span class="bg-yellow-100 text-yellow-700 text-xs font-black px-3 py-1 rounded-full"><?php echo count($announcementRequests); ?> Pending</span>
                </div>
                
                <div class="space-y-4">
                    <?php if (count($announcementRequests) > 0):
    foreach ($announcementRequests as $req):
?>
                        <div class="border border-slate-100 rounded-2xl p-5 bg-orange-50/50 relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-4 shrink-0 flex gap-2">
                                <a href="announcements.php?approve_request=<?php echo $req['id']; ?>" class="bg-green-100 text-green-700 hover:bg-green-200 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase transition-colors">Approve & Post</a>
                                <a href="announcements.php?reject_request=<?php echo $req['id']; ?>" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase transition-colors">Reject</a>
                            </div>
                            <div class="pr-40">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">From: <?php echo $req['sender_name']; ?> · <?php echo date('M d, Y', strtotime($req['timestamp'])); ?></p>
                                <h4 class="font-black text-[#102212] text-lg mb-2"><?php echo $req['subject']; ?></h4>
                                <p class="text-sm font-medium text-slate-600 bg-white p-4 rounded-xl border border-slate-100"><?php echo nl2br(htmlspecialchars($req['content'])); ?></p>
                            </div>
                        </div>
                    <?php
    endforeach;
else: ?>
                        <div class="text-center py-8">
                            <p class="text-slate-400 font-bold text-sm">No pending requests from students.</p>
                        </div>
                    <?php
endif; ?>
                </div>
            </div>

            <!-- Active Posted Announcements -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <h3 class="text-xl font-black text-[#102212] mb-6">Active Announcements</h3>
                
                <div class="space-y-4">
                    <?php if ((is_array($announcements) && count($announcements) > 0) || (is_object($announcements) && property_exists($announcements, 'num_rows') && $announcements->num_rows > 0)):
    foreach ($announcements as $ann):
?>
                        <div class="border border-slate-100 rounded-2xl p-5 flex justify-between items-start hover:border-[#13ec25]/50 transition-colors">
                            <div>
                                <p class="text-[10px] font-black text-[#13ec25] uppercase tracking-widest mb-1"><?php echo date('F d, Y', strtotime($ann['date'])); ?></p>
                                <h4 class="font-black text-[#102212] text-lg mb-2"><?php echo $ann['title']; ?></h4>
                                <p class="text-sm font-medium text-slate-600 line-clamp-2"><?php echo $ann['content']; ?></p>
                            </div>
                            <a href="announcements.php?delete_announcement=<?php echo $ann['id']; ?>" onclick="return confirm('Are you sure you want to delete this announcement?');" class="ml-4 shrink-0 text-slate-300 hover:text-red-500 transition-colors p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </a>
                        </div>
                    <?php
    endforeach;
else: ?>
                        <div class="text-center py-8">
                            <p class="text-slate-400 font-bold text-sm">No active announcements available.</p>
                        </div>
                    <?php
endif; ?>
                </div>
            </div>

        </div>
    </div>
</main>
</body>
</html>
