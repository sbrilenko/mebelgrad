<?php
//
print "<div class='galery_floors display_none'>
<div class='position_fixed galery_back' ></div>
   <div class='position_fixed z_index_9999 visitors_in_what_floor visit_floor_galery galery_floors_shadow '>
    		    <div class='back_and_padding_visit_floor_gal'>
    		    <div class='float_right'><div class='close_floor_gal position_absolute' title='Закрыть (Esc)'></div><div class='esc_out position_absolute'></div></div>";
$sql_slect_color_pomesh='SELECT * FROM floors';
$db->query($sql_slect_color_pomesh);
if($db->getCount()>0)
{
    $arr_select_color=$db->getArray();
    for($i=1;$i<4;$i++)
    {
        if($i==1)
        {
            print "<div class='tenants_first_floor height_for_floor_gal_visit_flo display_none'>
	    									   <div class='position_relative floor_color_ralative_coord_floor_1'>";
        }
        else
            if($i==2)
            {
                print "<div class='tenants_second_floor height_for_floor_gal_visit_flo display_none'>
	    									   <div class='position_relative floor_color_ralative_coord_floor_2'>";
            }
            else
            {
                print "<div class='tenants_threed_floor height_for_floor_gal_visit_flo display_none'>
	    									   <div class='position_relative floor_color_ralative_coord_floor_3'>";
            }
        foreach($arr_select_color as $arr_select_color_index=>$arr_select_color_value)
        {
            if($arr_select_color_value['floor']==$i)
            {
                if($arr_select_color_value['numb']=="101")
                {
                    print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								     		 <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 	 </div>";
                }
                /*else
                if($arr_select_color_value['numb']=="106")
                {
                     print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
                     <div class=' position_absolute'>
                      <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
                       <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
                       </div>
                    </div>";
                }*/
                else
                    if($arr_select_color_value['numb']=="112")
                    {
                        print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								     		  <div class='floor".$arr_select_color_value['numb']."_exaption_1 color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
                    }
                    else
                        if($arr_select_color_value['numb']=="116")
                        {
                            print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								     		  <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
                        }
                        else
                            if($arr_select_color_value['numb']=="209")
                            {
                                print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								     		  <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
                            }
                            else
                                if($arr_select_color_value['numb']=="223")
                                {
                                    print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								     		  <div class='floor".$arr_select_color_value['numb']."_exaption_2 color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
                                }
                                else
                                    if($arr_select_color_value['numb']=="223-a")
                                    {
                                        print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		  <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
                                    }
                                    else
                                        if($arr_select_color_value['numb']=="329")
                                        {
                                            echo "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none'>
									   <div class='position_absolute'>
						     				  <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
						     		 		  <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
						      	    	</div>
								    	</div>";
                                        }
                                        else
                                            if($arr_select_color_value['numb']=="338")
                                            {
                                                echo "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none'>
											 <div class='position_absolute'>
									     		  <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								      	     </div>";
                                            }
                                            else
                                                if($arr_select_color_value['numb']=="333")
                                                {
                                                    echo "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none'>
									<div class='position_absolute'>
						     		 	 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
						     		  	 <div class='floor".$arr_select_color_value['numb']."_exaption color_hover_pomesh opacity_0_6'></div>
						      	     </div>
						      	     </div>";
                                                }
                                                else
                                                    if($arr_select_color_value['numb']=="оф.1")
                                                    {
                                                        echo "<div class='id_of1 position_absolute display_none'>
									 <div class='position_absolute'>
						     		  <div class='floor_of1 color_hover_pomesh opacity_0_6'></div>
						      	     </div>

								    </div>";
                                                    }
                                                    else
                                                        if($arr_select_color_value['numb']=="оф.2")
                                                        {
                                                            echo "<div class='id_of2 position_absolute display_none'>
									 <div class='position_absolute'>
							     		  <div class='floor_of2 color_hover_pomesh opacity_0_6'></div>
							      	     </div>
								    </div>";
                                                        }
                                                        else
                                                            if($arr_select_color_value['numb']=="оф.3")
                                                            {
                                                                echo "<div class='id_of3 position_absolute display_none'>

									 <div class='position_absolute'>
						     		  <div class='floor_of3 color_hover_pomesh opacity_0_6' ></div>
						      	     </div>
								    </div>";
                                                            }
                                                            else
                                                                print "<div class='id_".$arr_select_color_value['numb']." position_absolute display_none' >
											 <div class=' position_absolute'>
								     		 <div class='floor".$arr_select_color_value['numb']." color_hover_pomesh opacity_0_6'></div>
								      	     </div>
								   		 </div>";
            }
        }
        print '</div></div>';
    }


}

print "
					<!--<div class='position_relative'><div class='esc_gal margin_top_10'>Esc выход</div></div>-->
				</div>
			</div>

		</div>
		</div>
 <!-- galery-->";
?>