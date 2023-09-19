<?php require "helpers.php"; ?>

<?php standardHeader(); ?>
</head>
<body>

	<div class="fixed-container">
	<div class="row">
		<div class="col-1">
		<?php writeUIButtons() ?>
			
		</div>
		<div class="col-11 pl-0">
			<div class="row">
				<div class="col">
					<div class="h1-container">
						<h1 class="green-box">Conclusion</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p class="green-box ">
						Lorem ipsum dolor sit <?php vocabularyWord("observation", "noun", "The gathering of information") ?> amet, 
						consectetur adipisicing elit. Etiam sollicitudin nibh in arcu lacinia, sit amet retrum massa <?php vocabularyWord("hypothesis", "Noun", "An idea or explanation for something that is based on known facts but has not yet been proved") ?> commodo. 
						Phasellus vitae nisi eget dolor facilisis. </p>
				</div>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="col-4">
				<div class= "background-image" style= "background-image: url('../../Design%20Files/images/storm-drain.jpg'); rotate: 5deg;"></div>
			</div>
			<div class="col-8">
				<p class="solid-blue-box"> <?php questionMarker(1);?> What did you discover by the outflow. <?php writeQuestionInput( $id, $class)?></p>
				
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class= "background-image" style= "background-image: url('../../Design%20Files/images/shark.png'); rotate: -5deg; "></div>
			</div>
			<div class="col-8">
				<p class="solid-light-purple-box"><?php questionMarker(2);?>How did that affect the Mako sharks live in their enviroment? <?php writeQuestionTextarea( $id, $class) ?></p>
			</div>
		</div>

<?php standardFooter(); ?>