### Usability
The platform should have a simple and clear interface for students.

### Reliability
The system should operate consistently with minimal downtime.

### Scalability
The platform should support an increasing number of users and posts.

### Approval Workflow

Every post follows a moderation workflow:

1. Pending – Post submitted by a student and waiting for review.
2. Approved – Post accepted and visible to other students.
3. Rejected – Post declined by the moderator.

### Core Features

- Login using school email pattern validation (simulation)
- Create marketplace listings
- Post announcements
- Approval workflow system
- Student dashboard
- Report post feature
- Search functionality
- Category filtering
- Simulated real-time updates using JavaScript polling every 10 seconds

### Student Dashboard

Students will have a personal dashboard displaying:

- My Posts
- Approved Posts
- Pending Posts
- Reported Posts

### Real-Time Update Simulation

The system will simulate real-time updates using *JavaScript polling, which refreshes post data every **10 seconds* so students can see newly approved listings without manual refresh.

### Non-Functional Requirements

#### Performance
Pages should load within 3 seconds for smooth user experience.

#### Security
- Email validation for student login
- Moderation approval system
- Report/flagging system for suspicious posts
