<html>
<head>
	<title>Buy Movies Online(Test)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	session_start();
	include 'connection.php';
	include 'authorisation.php';
	
	?>
  <div id="wrapper">
      <div id="inner">
          <div id="header">
              <div id="nav">
			  <a href="index.php">home</a> | 
                  <?php
						include 'header.php';
					?>
					<a href=""">help</a>
              </div>
              <img src="images/header_1.jpg" width="744" height="193" />
          </div><!-- end header -->
          
          <div id="body">
			<div class="inner">
			<?php
				$findMovie='';
				if (array_key_exists('recordsOnPage', $_GET))
				{
					$recordsOnPage = $_GET['recordsOnPage'];
				} else
				{
					$recordsOnPage = 12;
				}
				
				if (array_key_exists('findMovie', $_GET))
				{
					$findMovie = $_GET['findMovie'];
				}
																		
				
				if (array_key_exists('page', $_GET))
				{
					$page=$_GET['page'];
				} else {
					$page=1;
				}
			?>
			<div id="searchBar">
				<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="GET">
					<div id="setFindMovie">Find movie: <input type="text" name="findMovie" value="<?php echo $findMovie; ?>"></div>
					<div id="setRecOnPage">Records on page:
					<select name="recordsOnPage">
						<option name="10" <?php if ($recordsOnPage==10){echo "selected";}?> >10</option>
						<option name="12" <?php if ($recordsOnPage==12){echo "selected";}?> >12</option>
						<option name="14" <?php if ($recordsOnPage==14){echo "selected";}?> >14</option>
						<option name="16" <?php if ($recordsOnPage==16){echo "selected";}?> >16</option>
						<option name="18" <?php if ($recordsOnPage==18){echo "selected";}?> >18</option>
						<option name="20" <?php if ($recordsOnPage==20){echo "selected";}?> >20</option>
					</select>
					</div>
					<div id="buttonSearch">
					<input type="submit" name="Search" value="GO">
					</div>
				</form>
			</div>
			<?php		
					function printRowMovie(&$result, $rowCount, $skipRecords, $user)
					{ 
						for ($i=1; $i<=$skipRecords; $i++){$row=$result->fetch();}
						for ($i=1; $i<=$rowCount; $i++)
						{
							if ($row=$result->fetch())
							{
							?>
								<div class="leftbox">
									<h3><?php echo $row['title']; ?></h3>
									<a href="details.php?id=<?php echo $row['film_id']; ?>"><img src="images/Movies/<?php echo $row['film_id']; ?>.jpg" width="100" height="100" alt="photo 1" class="left" /></a>
									<p><?php echo substr($row['description'], 0, 100); ?></p>
									<p><b>Duration: </b><?php echo $row['length']; ?>  <b>Language:</b> <?php echo $row['language']; ?>  <b>Rating:</b> <?php echo $row['rating']; ?></p>
									<p class="readmore"><a href="addToBasket.php?user_id=<?php echo $user; ?>&film_id=<?php echo $row['film_id']; ?>">ADD TO BASKET</a></p>
									<div class="clear"></div>
								</div><!-- end .leftbox -->
							<?php
							} else
								{ return; }
							
							if ($row=$result->fetch())
							{
							?>
								<div class="rightbox">
									<h3><?php echo $row['title']; ?></h3>
									<a href="details.php?id=<?php echo $row['film_id']; ?>"><img src="images/Movies/<?php echo $row['film_id']; ?>.jpg" width="100" height="100"  alt="photo 1" class="left" /></a>
									<p><?php echo substr($row['description'], 0, 100); ?></p>
									<p><b>Duration: </b><?php echo $row['length']; ?>  <b>Language:</b> <?php echo $row['language']; ?>  <b>Rating:</b> <?php echo $row['rating']; ?></p>
									<p class="readmore"><a href="addToBasket.php?user_id=<?php echo $user; ?>&film_id=<?php echo $row['film_id']; ?>">ADD TO BASKET</a></p>
									<div class="clear"></div>
								</div><!-- end .rightbox -->
						  
								<div class="clear br"></div>
							<?php
							} else 
								{ return; }
						}
						
					} //end of function printRowMovie
					
					function printPageNumbers($howManyPg, $activePage, $argFindMovie, $argRecordsOnPage)
					{
						if ($howManyPg <= 10 or $activePage <= 5)
						{
							$offset = 0;
						} else 
							{
								$offset = $activePage - 5;
								if ($activePage+4 > $howManyPg){ $offset = $offset - $activePage - 4 + $howManyPg; }
							}			
						
						if ($activePage != 1){
							$returnStr = "<a href=\"index.php?page=1" . "&findMovie=" . $argFindMovie . "&recordsOnPage=" . $argRecordsOnPage . "\"><< </a><a href=\"index.php?page=" . ($activePage-1) . "&findMovie=" . $argFindMovie . "&recordsOnPage=" . $argRecordsOnPage . "\">< </a> ";
							} else {
								$returnStr = "<< < ";
								}
								
						for ($i=1+$offset; $i<=$offset+9 and $i<=$howManyPg; $i++)
						{
							if ($i != $activePage)
							{
								$returnStr = $returnStr . "<a href=\"index.php?page=" . $i . "&findMovie=" . $argFindMovie . "&recordsOnPage=" . $argRecordsOnPage . "\">";
								$returnStr = $returnStr . $i . " ";
								$returnStr = $returnStr . "</a> ";
							} else {
								$returnStr = $returnStr . $i . " ";
									}
						}
						
						if ($activePage != $howManyPg){
							$returnStr = $returnStr . "<a href=\"index.php?page=" . ($activePage+1) . "&findMovie=" . $argFindMovie . "&recordsOnPage=" . $argRecordsOnPage . "\">> </a><a href=\"index.php?page=" . $howManyPg . "&findMovie=" . $argFindMovie . "&recordsOnPage=" . $argRecordsOnPage . "\">>> </a> ";
							} else {
								$returnStr = $returnStr . "> >> ";
								}
						return $returnStr;
					}
					
					
					
					$result=$db->query("SELECT film.film_id,
												film.title,
												description,
												lang.name language,
												film.release_year,
												film.rental_rate,
												film.length,
												film.rating
											FROM film left join language lang on lang.language_id=film.language_id WHERE title like '%". $findMovie ."%' or description like '%". $findMovie ."%'");

								
					$filmCount = $result->rowCount();
					$howManyPages = ceil($filmCount / $recordsOnPage);
					if ($page>$howManyPages){$page=1;}
					$skipRecords = $recordsOnPage * ($page - 1);
					
					printRowMovie($result, ceil($recordsOnPage/2), $skipRecords, $user_id);
					
					
				?>
                  
              </div><!-- end .inner -->
          </div><!-- end body -->
          <div class="clear"></div>
          <div id="footer">
			<?php if ($howManyPages>0){ echo printPageNumbers($howManyPages, $page, $findMovie, $recordsOnPage);} ?>

          </div><!-- end footer -->
      </div><!-- end inner -->
  </div><!-- end wrapper -->
</body>
</html>
