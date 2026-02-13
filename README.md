[![Français](https://img.shields.io/badge/lang-FR-blue)](/docs/README_fr.md)
[![English](https://img.shields.io/badge/lang-EN-red)](README.md)



# Grade Management System

A professional, user-friendly grade management application built with PHP and Bootstrap 5. This application provides administrators with complete control over student records, subjects, and grade management.

## Features

### Student Management
- **Add Students**: Enter new student information with detailed fields
- **View All Students**: Display all active students in a professional table format
- **Edit Student Data**: Modify student information at any time
- **Delete Students**: Remove student records (soft delete)
- **Search Students**: Search by name, email, or admission number

### Subject Management
- **Add Subjects**: Create new subjects with codes and descriptions
- **View All Subjects**: Display all active subjects
- **Edit Subject Data**: Update subject information
- **Delete Subjects**: Remove subjects from the system
- **Search Subjects**: Quick search by name or code

### Grade Management
- **Add Grades**: Enter student grades for subjects
- **View All Grades**: Complete grade listing with filters
- **Edit Grades**: Modify grades and remarks
- **Delete Grades**: Remove grade records
- **Automatic Grade Calculation**: Grades are automatically calculated based on marks
- **Class-wise Reports**: View grades organized by class

### Additional Features
- Professional admin dashboard with statistics
- Responsive design for all devices
- Security with admin authentication
- Session management
- Comprehensive error handling
- Alert notifications for user actions

## Grading Scale

| Grade | Marks Range |
|-------|-------------|
| A     | 90-100      |
| B     | 80-89       |
| C     | 70-79       |
| D     | 60-69       |
| F     | < 60        |

## Installation & Setup

### Prerequisites
- XAMPP (or any local server with PHP 7.4+ and MySQL)
- Web browser
- Text editor for configuration

### Step-by-Step Installation

1. **Extract Files**
   - Extract the project to `C:\xampp\htdocs\gn\`

2. **Create Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database named `grade_management`
   - Import the `database.sql` file:
     - Click on the new database
     - Go to Import tab
     - Select and upload `database.sql`

3. **Configure Database Connection**
   - Open `includes/config.php`
   - Update database credentials if different:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "grade_management";
     ```

4. **Start XAMPP**
   - Start Apache and MySQL services

5. **Access the Application**
   - Open browser and navigate to: `http://localhost/gn/login.php`

## Default Login Credentials

**Username**: `admin`  
**Password**: `admin123`

⚠️ **IMPORTANT**: Change these credentials after first login!

## File Structure

```
gn/
├── index.php                 # Dashboard/Home page
├── login.php                 # Login page
├── logout.php                # Logout handler
├── database.sql              # Database schema & initial data
│
├── includes/
│   ├── config.php            # Database configuration
│   ├── auth.php              # Authentication functions
│   ├── header.php            # Page header template
│   ├── footer.php            # Page footer template
│   ├── student_functions.php # Student management functions
│   ├── subject_functions.php # Subject management functions
│   └── grade_functions.php   # Grade management functions
│
├── public/
│   ├── students.php          # View all students
│   ├── add_student.php       # Add new student
│   ├── edit_student.php      # Edit student
│   ├── delete_student.php    # Delete student handler
│   ├── view_student.php      # View student details
│   ├── search_student.php    # Search students
│   │
│   ├── subjects.php          # View all subjects
│   ├── add_subject.php       # Add new subject
│   ├── edit_subject.php      # Edit subject
│   ├── delete_subject.php    # Delete subject handler
│   ├── search_subject.php    # Search subjects
│   │
│   ├── grades.php            # View all grades
│   ├── add_grade.php         # Add new grade
│   ├── edit_grade.php        # Edit grade
│   ├── delete_grade.php      # Delete grade handler
│   └── class_grades.php      # View grades by class
│
├── assets/
│   ├── css/
│   │   └── style.css         # Custom styling
│   └── js/
│       └── script.js         # JavaScript functions
│
└── uploads/                  # Directory for file uploads

```

## Database Schema

### Admin Table
Stores administrator credentials for system access.

### Students Table
- Student personal information
- Contact details
- Guardian information
- Status tracking (active/inactive)

### Subjects Table
- Subject name and code
- Subject description
- Teacher information
- Credit hours

### Grades Table
- Student and subject relationship
- Marks and calculated grades
- Academic year and semester
- Remarks and comments
- Automatic timestamp tracking

## Usage Guide

### Adding a Student
1. Navigate to Students → Add New Student
2. Fill in required fields (Name, Class)
3. Complete optional information
4. Click "Add Student"

### Adding a Subject
1. Navigate to Subjects → Add New Subject
2. Enter Subject Name and Code (required)
3. Add teacher information and credit hours
4. Click "Add Subject"

### Adding a Grade
1. Navigate to Grades → Add New Grade
2. Select Student and Subject
3. Enter marks (0-100)
4. Specify academic year and semester
5. Click "Add Grade"
6. Grade is automatically calculated

### Searching
- Use the search feature in Students or Subjects sections
- Search by name, email, or code
- Results update in real-time

### Viewing Reports
- Go to Grades → Class Grades Report
- View all student grades organized by class
- See subjects, marks, and grades for each student

## Security Features

- **Session-based authentication**: User must login to access
- **SQL Injection Prevention**: Prepared statements used
- **XSS Protection**: Input sanitization with htmlspecialchars()
- **Soft Deletes**: Records not permanently deleted, can be restored
- **Password Security**: Passwords hashed with SHA2(256)

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Common Issues & Solutions

### Issue: Database Connection Failed
**Solution**: 
- Verify MySQL is running
- Check credentials in `includes/config.php`
- Ensure database `grade_management` exists

### Issue: Cannot Login
**Solution**:
- Verify admin user exists in database
- Check database import was successful
- Clear browser cache and cookies

### Issue: public Not Loading
**Solution**:
- Verify Apache is running
- Check file permissions
- Ensure all files are in correct directories

## Customization

### Change Grading Scale
Edit `grade_functions.php` - `calculateGrade()` function to modify grade boundaries.

### Change Color Theme
Modify color variables in `assets/css/style.css`:
```css
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
    /* ... */
}
```

### Add New Fields
1. Add columns to database tables
2. Update relevant function files
3. Update form public with new fields

## Backup & Recovery

**Backup Database**:
```sql
mysqldump -u root -p grade_management > backup.sql
```

**Restore Database**:
```sql
mysql -u root -p grade_management < backup.sql
```

## Support & Maintenance

- Regularly backup your database
- Keep credentials secure
- Monitor user activity in logs
- Update to latest PHP versions
- Test before making changes to production

## Future Enhancements

- Student attendance tracking
- Bulk grade import from Excel
- Email notifications
- Advanced reporting and analytics
- Parent portal access
- Mobile app version
- Multi-class support

## License

This project is free to use and modify for educational and commercial purposes.

## Author

**Nsengimana François** Software Developer

Developed as a comprehensive grade management solution.

## Contact

- Email: [francknsengimana@gmail.com](mailto:francknsengimana@gmail.com)
- LinkedIn: [Linkedin](https://www.linkedin.com/in/françois-nsengimana)

---

**Version**: 1.0  
**Last Updated**: February 2026  
**Status**: Production Ready
