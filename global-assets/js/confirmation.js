function viewApplication(id,aplno,sl) {
    window.open('application-form.php?std_id='+id+'&s_aplno='+aplno+'&sl='+sl, 'newwindow', 'width=1000,height=300');return false;
}

function approveApplication(sl,std_id) {
    window.location.href="global-assets/php/approve-application.php?sl="+sl+"&std_id="+std_id;
}

function viewApplicationsDatabase(id){
    window.open('applications-database.php?i_id='+id, 'newwindow', 'width=1000,height=300');return false;
}

function viewStudentsDatabase(id){
    window.open('students-database.php?ins_id='+id, 'newwindow', 'width=1000,height=300');return false;
}

function updateInstitute(id){
    window.location.href="update-institute.php?ins_id="+id;
}

function viewInstitute(id){
    window.open('institute-view.php?ins_id='+id, 'newwindow', 'width=1000,height=300');return false;
}

function approveInstitute(id) {
    window.location.href="global-assets/php/approve-institute.php?ins_id="+id;
}

function viewInstituteDatabase(){
    window.open('institute-database.php', 'newwindow', 'width=1000,height=300');return false;
}

function viewApplicationAdmin(id){
    window.open('application-form-admin.php?std_id='+id, 'newwindow', 'width=1000,height=300');return false;
}

function viewApplicationDatabase(){
    window.open('application-database.php', 'newwindow', 'width=1000,height=300');return false;
}

function confirmAdmission(id,sl){
    window.location.href="global-assets/php/confirm-admission.php?std_id="+id+"&sl="+sl;
}

function viewStudentCard(id){
    window.open('student-view.php?std_id='+id, 'newwindow', 'width=1000,height=300');return false;
}

function viewStudentsDatabaseAdmin(){
    window.open('students-database-admin.php', 'newwindow', 'width=1000,height=300');return false;
}

function deleteApplicationAdmin(id){
    window.location.href="global-assets/php/delete-application.php?s_id="+id;
}

function deleteInstitute(id){
    window.location.href="global-assets/php/delete-institute.php?ins_id="+id;
}
