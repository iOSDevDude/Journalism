<div class="" id="listRow">
	<table id="studentListTable">
		<thead>
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>KSC email</th>
				<th>Class</th>
				<th>Catalog Year</th>
				<th>Major</th>
				<th>JRN Option</th>
				<th>Minor</th>
				<th>Advisor name</th>
				<th data-sortable="false"></th>
				<th data-sortable="false"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($students as $student): ?>
				<tr>
					<td><?php echo $student['FirstName']?></td>
					<td><?php echo $student['LastName']?></td>
					<td><?php echo $student['KSCEmail']?></td>
					<td><?php echo $student['Classification']?></td>
					<td><?php echo $student['CatalogYear']?></td>
					<td><?php echo (empty($student['MajorNames']) ? "--" : $student['MajorNames'])?></td>
					<td><?php echo $student['JRNOption']?></td>
					<td><?php echo (empty($student['MinorNames']) ? "--" : $student['MinorNames'])?></td>
					<td><?php echo (empty($student['AdvisorNames']) ? "--" : $student['AdvisorNames'])?></td>
					<td><a href="<?php echo site_url('studentrecord/' . substr($student['KSCEmail'],0,strpos($student['KSCEmail'],'@'))) . '/' . substr($student['KSCEmail'],strpos($student['KSCEmail'],'@')+1) ?>">View</a></td>
					<td><a href="<?php echo site_url('studentlist/delete_student/'.substr($student['KSCEmail'],0,strpos($student['KSCEmail'],'@'))) . '/' . substr($student['KSCEmail'],strpos($student['KSCEmail'],'@')+1);?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
