INSTITUT D'ENSEIGNEMENT SUPERIEUR DE RUHENGERI
FACULTY OF SCIENCES AND INFORMATION TECHNOLOGY
DEPARTMENT OF COMPUTER SCIENCE

UNISTACK - INES DIGITAL NOTICE BOARD + MARKETPLACE
USER MANUAL
Project C: Advanced Web Design & Development - Assignment #2
====================================================================

TABLE OF CONTENTS
-----------------
1. INTRODUCTION
2. SYSTEM ACCESS
3. USER ROLES & PERMISSIONS
4. GETTING STARTED
5. STUDENT GUIDE
6. MODERATOR GUIDE
7. ADMIN GUIDE
8. POST MANAGEMENT
9. REPORTING SYSTEM
10. SEARCH & FILTERS
11. TROUBLESHOOTING
12. CONTACT & SUPPORT

====================================================================
1. INTRODUCTION
====================================================================

The INES Digital Notice Board + Marketplace (UniStack) is a student-only
platform designed to replace WhatsApp groups for buying/selling items,
sharing housing information, and posting announcements. It eliminates
scams and lost messages by providing a structured, moderated environment.

Purpose:
- Safe marketplace for INES students
- Housing information sharing
- Official announcements
- Scam prevention through moderation

====================================================================
2. SYSTEM ACCESS
====================================================================

Platform URL: [Your Live URL Here]
Repository: [Your GitHub Repo URL Here]

Browser Requirements:
- Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- JavaScript enabled
- Cookies enabled

====================================================================
3. USER ROLES & PERMISSIONS
====================================================================

+------------------+--------------------------------------------------+
| ROLE             | PERMISSIONS                                      |
+------------------+--------------------------------------------------+
| STUDENT          | - Register/Login with school email               |
|                  | - Create posts (For Sale/Housing/Announcement)   |
|                  | - View all approved posts                        |
|                  | - Edit/delete own posts                          |
|                  | - Report inappropriate content                   |
|                  | - View personal dashboard                        |
+------------------+--------------------------------------------------+
| MODERATOR        | - All student permissions                         |
|                  | - Approve/reject pending posts                   |
|                  | - Remove inappropriate posts                     |
|                  | - Manage reported content                         |
|                  | - Warn/suspend users                             |
+------------------+--------------------------------------------------+
| ADMIN            | - All moderator permissions                       |
|                  | - Manage users (add/edit/delete)                 |
|                  | - Full system configuration                       |
|                  | - View system logs                                |
|                  | - Assign moderators                               |
+------------------+--------------------------------------------------+

====================================================================
4. GETTING STARTED
====================================================================

4.1 Registration
----------------
1. Navigate to the login page
2. Click "Register" button
3. Fill in required information:
   - Full Name
   - Email (must be @ines.ac.rw pattern)
   - Password
   - Confirm Password
   - Student ID
4. Click "Submit"
5. Wait for admin approval (first-time only)

4.2 Login
---------
1. Enter your email
2. Enter your password
3. Click "Login"
4. You will be redirected to your role-specific dashboard

4.3 Test Credentials
--------------------
For testing purposes, use:
--------------------------------------------------
| ROLE       | EMAIL                  | PASSWORD  |
--------------------------------------------------
| Student    | student@ines.ac.rw     | password123 |
| Moderator  | moderator@ines.ac.rw   | password123 |
| Admin      | admin@ines.ac.rw       | password123 |
--------------------------------------------------

====================================================================
5. STUDENT GUIDE
====================================================================

5.1 Student Dashboard
---------------------
After login, students see:
- My Posts (count and list)
- Approved Posts (count)
- Pending Posts (count)
- Quick post creation button
- Recent activity feed
- Reports summary

5.2 Creating a Post
-------------------
Step-by-step process:

1. From dashboard, click "Create New Post"
2. Select Post Type:
   
   A. FOR SALE
      - Item name
      - Description
      - Price (RWF)
      - Condition (New/Like New/Good/Fair)
      - Location on campus
      - Image URL (optional placeholder)
      - Contact preference
   
   B. HOUSING
      - Title
      - Description
      - Location (Musanze area)
      - Price (RWF/month)
      - Room type (Single/Shared)
      - Available from date
      - Amenities (checkbox)
      - Contact info
   
   C. ANNOUNCEMENT
      - Title
      - Description
      - Category (Event/Study/Club/Other)
      - Date of event (if applicable)
      - Location
      - Contact info

3. Click "Submit Post"
4. Post status becomes "Pending"
5. Wait for moderator approval

5.3 Managing Your Posts
-----------------------
View My Posts:
1. Click "My Posts" on dashboard
2. See all your posts with status indicators:
   - 🟡 Pending
   - 🟢 Approved
   - 🔴 Rejected
   - ⚫ Expired

Edit Post:
1. Find post in "My Posts"
2. Click "Edit" button
3. Update information
4. Submit changes (goes back to pending)

Delete Post:
1. Find post in "My Posts"
2. Click "Delete" button
3. Confirm deletion

====================================================================
6. MODERATOR GUIDE
====================================================================

6.1 Moderator Dashboard
-----------------------
Special features:
- Pending Posts Queue
- Reported Content Queue
- Approval Stats
- Recent Actions Log
- User Reports Summary

6.2 Approving/Rejecting Posts
-----------------------------
1. Go to "Pending Posts"
2. Review each post:
   - Check for inappropriate content
   - Verify pricing (if too good to be true)
   - Ensure proper category
   - Validate contact info
3. Take action:
   - ✅ APPROVE: Post becomes visible to all
   - ❌ REJECT: Provide reason (sent to user)
   - 📝 REQUEST EDIT: Ask for changes

6.3 Managing Reports
--------------------
1. Go to "Reported Content"
2. View reported posts with reason
3. Investigate the issue
4. Take appropriate action:
   - Remove post if violation
   - Warn user
   - Ignore if false report
   - Ban user for repeated violations

====================================================================
7. ADMIN GUIDE
====================================================================

7.1 Admin Dashboard
-------------------
Full system overview:
- Total Users
- Total Posts
- Pending Approvals
- Reports Queue
- System Health
- User Activity Log
- Moderation Stats

7.2 User Management
-------------------
Add User:
1. Click "Users" → "Add New"
2. Fill user details
3. Assign role
4. Set temporary password

Edit User:
1. Find user in list
2. Click "Edit"
3. Modify permissions/status
4. Save changes

Delete/Suspend User:
1. Select user
2. Choose "Suspend" or "Delete"
3. Confirm action
4. Reason logged for audit

7.3 System Configuration
------------------------
- Set post approval requirements
- Configure report thresholds
- Manage email notifications
- View audit logs
- Backup data

====================================================================
8. POST MANAGEMENT
====================================================================

8.1 Post Status Workflow
------------------------
                    ┌─────────────────┐
                    │  STUDENT POSTS  │
                    └────────┬────────┘
                             │
                    ┌────────▼────────┐
                    │    PENDING      │◄─────┐
                    │  (Awaiting Mod) │      │
                    └────────┬────────┘      │
                             │                │
                 ┌───────────┼───────────┐    │
                 ▼           ▼           ▼    │
          ┌─────────┐ ┌─────────┐ ┌─────────┐ │
          │APPROVED │ │REJECTED │ │NEEDS    │ │
          │Visible  │ │Not shown│ │EDIT     │─┘
          │to all   │ │         │ │         │
          └─────────┘ └─────────┘ └─────────┘

8.2 Post Types & Requirements
-----------------------------
+---------------+---------------------+------------------+
| POST TYPE     | REQUIRED FIELDS     | VALIDATION RULES |
+---------------+---------------------+------------------+
| For Sale      | Title, Description, | Price > 0        |
|               | Price, Condition    |                  |
+---------------+---------------------+------------------+
| Housing       | Location, Price,    | Price/month > 0  |
|               | Available Date      | Future date ok   |
+---------------+---------------------+------------------+
| Announcement  | Title, Description, | Valid date if    |
|               | Category            | event specified  |
+---------------+---------------------+------------------+

====================================================================
9. REPORTING SYSTEM
====================================================================

9.1 How to Report a Post
------------------------
1. View any post (must be logged in)
2. Click "Report" button below the post
3. Select reason:
   - Spam
   - Inappropriate content
   - Scam/fraud
   - Wrong category
   - Duplicate post
   - Other
4. Add comment (optional)
5. Submit report

9.2 What Happens After Reporting
--------------------------------
1. Report goes to moderators
2. Post gets flagged in system
3. Moderator reviews within 24 hours
4. Action taken if needed
5. Reporter gets notification (if enabled)

====================================================================
10. SEARCH & FILTERS
====================================================================

10.1 Basic Search
-----------------
- Use search bar at top of page
- Search by keywords in title/description
- Results update in real-time

10.2 Advanced Filters
---------------------
Filter by:
- Category (For Sale/Housing/Announcement)
- Price range (min-max)
- Date posted (Today/This week/This month)
- Status (Approved only)
- Location (if applicable)

10.3 Sort Options
-----------------
- Newest first (default)
- Oldest first
- Price: Low to High
- Price: High to Low
- Most reported (moderators only)

====================================================================
11. REAL-TIME SIMULATION
====================================================================

The platform simulates real-time updates using JavaScript polling:

- Page refreshes every 10 seconds
- New posts appear automatically
- Status changes update without manual refresh
- Report counts update in real-time

To see this in action:
1. Open two browsers/windows
2. Post something in one
3. Watch it appear in the other within 10 seconds (after approval)

====================================================================
12. TROUBLESHOOTING
====================================================================

12.1 Common Issues & Solutions
-------------------------------
+---------------------+---------------------------------------------+
| PROBLEM             | SOLUTION                                    |
+---------------------+---------------------------------------------+
| Can't login         | - Check email format (@ines.ac.rw)          |
|                     | - Reset password                            |
|                     | - Contact admin if account not approved     |
+---------------------+---------------------------------------------+
| Post not appearing  | - Check status in "My Posts"                |
|                     | - May be pending approval                    |
|                     | - Contact moderator if stuck                 |
+---------------------+---------------------------------------------+
| Report not working  | - Must be logged in                          |
|                     | - Cannot report own posts                    |
|                     | - Try again or contact admin                 |
+---------------------+---------------------------------------------+
| Page not refreshing | - Check internet connection                  |
|                     | - Enable JavaScript                          |
|                     | - Clear browser cache                        |
+---------------------+---------------------------------------------+

12.2 Error Messages
-------------------
- "Invalid email pattern": Use @ines.ac.rw email
- "Post limit reached": You've posted too many today
- "Content inappropriate": Post contains blocked words
- "Session expired": Login again

====================================================================
13. SYSTEM REQUIREMENTS & SPECIFICATIONS
====================================================================

Technical Specifications:
- Built with PHP MVC architecture
- MySQL database with prepared statements
- Responsive design (mobile + desktop)
- 10-second polling for real-time simulation
- Minimum 25 commits in Git history
- Prepared statements for all DB operations

Security Features:
- Role-based access control
- SQL injection protection (prepared statements)
- Session management
- Input validation
- XSS prevention

====================================================================
14. CONTACT & SUPPORT
====================================================================

For Technical Support:
----------------------
Course Instructor: mclement@ines.ac.rw
CC: ambitieux.clement@gmail.com

System Administrators:
- [Name], [email]
- [Name], [email]

Report System Issues:
- Use the "Report" feature
- Contact your class representative
- Email the instructor with details

Emergency Contact:
- Include "URGENT - UniStack" in subject line
- Describe the issue clearly
- Include screenshots if possible

====================================================================
QUICK REFERENCE CARD
====================================================================

┌─────────────────────────────────────────────────────────────────┐
│                         QUICK TIPS                              │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ✅ DO's:                                                       │
│  • Use clear, descriptive titles                                 │
│  • Set realistic prices                                          │
│  • Check post status in dashboard                               │
│  • Report suspicious posts                                      │
│  • Update or delete sold items                                  │
│                                                                  │
│  ❌ DON'Ts:                                                      │
│  • Don't share personal contacts in posts                       │
│  • Don't post duplicate items                                   │
│  • Don't use inappropriate language                             │
│  • Don't post off-topic content                                 │
│  • Don't spam the platform                                      │
│                                                                  │
│  ⌨️ KEYBOARD SHORTCUTS:                                          │
│  • Ctrl/Cmd + F : Search                                        │
│  • Ctrl/Cmd + N : New post                                      │
│  • Ctrl/Cmd + D : Dashboard                                     │
│  • Esc : Close modal/dialog                                     │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘

====================================================================
VERSION HISTORY
====================================================================
Version 1.0 - Initial Release
Last Updated: March 2026
Project: Web_Ass_2_Group_[#]_II_A/B

====================================================================
© 2026 INES Ruhengeri - Department of Computer Science
All rights reserved. For educational purposes only.
====================================================================
