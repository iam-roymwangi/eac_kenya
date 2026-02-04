# EAC Green Group Automated Onboarding System

## Overview

This system implements a secure, sequential onboarding workflow for EAC Green Group's renewable energy projects. The workflow follows the EAC 7-Step Client Handling Process, with the first 3 steps automated through a web-based interface.

## Features

### Step 1: NDA Signing (QR Code Entry)
- **Access**: Clients scan a QR code with a signed URL `/onboarding/{uuid}`
- **Security**: 48-hour expiration, disabled right-click/print, non-downloadable
- **Interface**: Scrollable NDA text with digital signature capture using signature_pad
- **Action**: Saves Base64 signature and timestamp, advances to Step 2

### Step 2: Inception Meeting (Automated Transition)
- **Access**: Automatic redirect after Step 1 completion
- **Interface**: Project overview with meeting objectives and outcomes
- **Action**: Simulates meeting completion, advances to Step 3

### Step 3: RFQ & Documentation
- **Access**: Automatic redirect after Step 2 completion
- **Interface**: Multi-file upload dashboard for technical drawings and requirements
- **Features**: 
  - Technical drawings upload (PDF, DWG, DXF, JPG, PNG)
  - Regulatory requirements form
  - Financial assumptions collection
  - Project timeline and environmental considerations
- **Action**: Saves all data to database and file storage

## Technical Implementation

### Backend (Laravel 12)
- **Models**: Project, Company, Document
- **Middleware**: `CheckOnboardingStep` - enforces sequential access
- **Controllers**: `OnboardingController` - handles all three steps
- **Storage**: Private disk for secure file uploads
- **Security**: Signed URLs with expiration, step validation

### Frontend (Vue 3 + Inertia.js)
- **Components**: Separate Vue components for each step
- **Styling**: Tailwind CSS with Slate/Emerald theme
- **UX**: Progress indicators, seamless transitions, responsive design
- **Security**: Disabled right-click, print prevention, signature capture

### Database Schema
```sql
-- Projects table with onboarding workflow tracking
projects:
  - uuid (unique identifier for QR codes)
  - current_step (workflow position)
  - qr_expires_at (QR code expiration)
  - nda_signature (Base64 signature data)
  - nda_signed_at, inception_completed_at, rfq_completed_at
  - rfq_data (JSON storage for form submissions)
```

## Admin Interface

### Project Management
- **Route**: `/admin/projects`
- **Features**:
  - Create new projects
  - View project details and progress
  - Generate QR codes with custom expiration
  - Reset project steps for testing
  - Monitor onboarding status

### QR Code Generation
```bash
# Command line
php artisan project:generate-qr {uuid} --hours=48

# Admin interface
/admin/projects/{id} -> Generate QR Code button
```

## Usage Instructions

### For Administrators
1. **Create Project**: Use admin interface to create new project
2. **Generate QR**: Set expiration (24-168 hours) and generate QR code
3. **Share QR**: Print or digitally share QR code with client
4. **Monitor Progress**: Track completion through admin dashboard

### For Clients
1. **Scan QR Code**: Access onboarding URL via QR code
2. **Sign NDA**: Read and digitally sign the non-disclosure agreement
3. **Inception Meeting**: Review project details and complete meeting
4. **Submit RFQ**: Upload documents and provide project requirements

## Security Features

### Access Control
- **Signed URLs**: Cryptographically signed with expiration
- **Step Validation**: Middleware prevents skipping steps
- **Session Management**: No authentication required for clients

### Data Protection
- **Private Storage**: Uploaded files stored in private disk
- **Signature Security**: Base64 encoded signatures with timestamps
- **Input Validation**: Comprehensive form validation and file type restrictions

### UI Security
- **Right-click Disabled**: Prevents easy copying of NDA text
- **Print Prevention**: CSS and JS blocks printing attempts
- **Non-downloadable**: NDA text cannot be easily saved

## File Structure

```
app/
├── Console/Commands/GenerateProjectQR.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/ProjectAdminController.php
│   │   └── OnboardingController.php
│   └── Middleware/CheckOnboardingStep.php
├── Models/
│   ├── Company.php
│   └── Project.php
└── ...

resources/js/pages/
├── Admin/
│   ├── CreateProject.vue
│   ├── ProjectDetail.vue
│   └── Projects.vue
└── Onboarding/
    ├── Complete.vue
    ├── StepOne.vue
    ├── StepTwo.vue
    └── StepThree.vue

database/migrations/
├── create_projects_table.php
├── create_companies_table.php
└── ...
```

## Testing

### Sample Projects
Run the seeder to create test projects:
```bash
php artisan db:seed --class=ProjectSeeder
```

### Generate Test QR
```bash
php artisan project:generate-qr {uuid}
```

### Admin Access
1. Register/login to access admin interface
2. Navigate to `/admin/projects`
3. Create or manage existing projects

## Next Steps (Steps 4-7)

The system is designed to extend to the full 7-step EAC process:
- **Step 4**: Proposal Development
- **Step 5**: Contract Negotiation  
- **Step 6**: Project Execution
- **Step 7**: Project Completion

Each step can be added following the same pattern with appropriate middleware, controllers, and Vue components.

## Configuration

### Environment Variables
```env
APP_URL=https://your-domain.com
FILESYSTEM_DISK=private
```

### File Upload Limits
- **Max file size**: 10MB per file
- **Allowed types**: PDF, DWG, DXF, JPG, PNG
- **Storage**: `storage/app/private/projects/{uuid}/`

## Support

For technical support or questions about the onboarding system:
- **Email**: tech@eacgreen.co.ke
- **Documentation**: This README file
- **Admin Interface**: `/admin/projects` for project management