<select  name="city_l" id="city_l" class="form-control" >
                          <option value="">None</option>
                          <?php 

								 $sql7="select * from `location_masters` ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; if($row['city_l']==$row7['id']) echo 'selected'; echo '>'.$row7['location'].'</option>';

								 }

					 			?>
                        </select>