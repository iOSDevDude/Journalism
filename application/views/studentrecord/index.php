<div class="row">
  <div style="margin-top:15px;" class="large-12 columns text-center">
    <?php
      echo("<h1>$student->FirstName $student->LastName</h1>");
     ?>
   </div>
 </div>
 <form method="post" id="recordPageForm">
   <div class="row">
       <input type="submit" value="Submit Changes" name="update"/>
   </div>

   <div class="row">
       <label>First Name: </label>
       <?php $firstName=$student->FirstName; echo("<input type=\"text\" name=\"studentFirstName\" value=$firstName>") ?>
       <label>Last Name: </label>
       <?php echo("<input type=\"text\" name=\"studentLastName\" value=$student->LastName>") ?>
       <label>KSC Email: </label>
       <?php echo("<input type=\"email\" name=\"studentKSCEmail\" value=$student->KSCEmail disabled>") ?>
       <label>Alternate Email: </label>
       <?php echo("<input type=\"email\" name=\"studentAlternateEmail\" value=$student->AltEmail>") ?>
       <label>Classification: </label>
       <select name="classification">
         <?php
          foreach($classifications as $classification):
            if($student->ClassificationID == $classification['ID']) {
              echo("<option selected='selected'>");
            } else {
              echo("<option>");
            }
            echo($classification['Class']);
            echo("</option>");
          endforeach;
         ?>
       </select>
       <label>Catalog Year: </label>
       <?php echo("<input type=\"text\" name=\"studentCatalogYear\" value=$student->CatalogYear>")?>
       <label>Advisor: </label>
       <select name="advisor">
         <?php
          foreach($advisors as $advisor):
            //This needs improvment later (They may have multiple advisors, but this is restricted in the model)
            if($studentAdvisor->AdvisorID == $advisor['ID']) {
              echo("<option value=".$advisor['ID']." selected='selected'>");
            } else {
              echo("<option value=".$advisor['ID'].">");
            }
            echo($advisor['FirstName'].' '.$advisor['LastName']);
            echo("</option>");
          endforeach;
          ?>
       </select>
       <!--FIXME: Issue updating database-->
       <label>Major Declared: </label>
       <select name="majorDeclared">
         <?php
          if($student->MajorDeclared == "0") {
            echo("<option value=\"0\" selected>No</option>");
            echo("<option value=\"1\">Yes</option>");
          } else {
            echo("<option value=\"0\">No</option>");
            echo("<option value=\"1\" selected>Yes</option>");
          }
         ?>
       </select>
       <label>JRN Option: </label>
       <select name="jrnOption">
         <?php
          foreach($jrnoptions as $jrnoption):
          if($student->JRNOptionID == $jrnoption['ID']) {
            echo("<option selected='selected'>");
          } else {
            echo("<option>");
          }
          echo($jrnoption['Type']);
          echo("</option>");
          endforeach;
         ?>
       </select>
       <label>Minor Declared: </label>
       <select name="minorDeclared">
         <?php
          if($student->MinorDeclared == "0") {
            echo("<option value=\"0\" selected>No</option>");
            echo("<option value=\"1\">Yes</option>");
          } else {
            echo("<option value=\"0\">No</option>");
            echo("<option value=\"1\" selected>Yes</option>");
          }
         ?>
       </select>
   </div>
   <br><br>
   <div class="row">
     <table id="courseRecordTable">
       <thead>
         <tr>
           <th>Course Level</th>
           <th>Course Name</th>
           <th>Status</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($courses as $course): ?>
         <tr>
           <td><?php echo($course['Prefix']."-".$course['Number'])?></td>
           <td><?php echo($course['Name'])?></td>
           <td>
             <select name=<?php echo("course_".$course['ID'])?>>
                 <?php
                 $attempted = 0;
                 foreach($courseStatuses as $courseStatus):
                     if($courseStatus['CourseID'] == $course['ID']) {
                         echo($courseStatus['Description']);
                         $attempted = $courseStatus['CompletionStatusID'];
                         break;
                     }
                 endforeach;
                 for($i=0; $i<=count($courseCompletionOptions); $i++) {
                     if($i == $attempted) {
                         echo("<option selected>");
                     } else {
                         echo("<option>");
                     }
                     if($i == 0) {
                         echo("Not attempted");
                     } else {
                         echo($courseCompletionOptions[$i-1]['Description']);
                     }
                     echo("</option>");
                 }
                 ?>
             </select>
           </td>
         </tr>
        <?php endforeach; ?>
       </tbody>
     </table>
   </form>
 </div>

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
 <script>
 	$(document).ready(function() {
 	    $('#courseRecordTable').DataTable( {
        "pageLength" : 20,
        "lengthMenu": [[10,20,30,-1], [10,20,30,"All"]]
      } );
 	});
 </script>
