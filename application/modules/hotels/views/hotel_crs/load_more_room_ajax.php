                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                              <thead>
                                <tr>
                                  <th style="width: 30%">Room</th>
                                  <th style="width: 10%" class="hidden-phone">Inclusion</th>
                                  <th style="width: 30%" class="hidden-phone">Net Price</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              foreach($more_details_result as $vale) 
                              { 
                                $meal=explode(',', $vale->board_type);
                                 $meal_plan_arr=array();
                                 foreach ($meal as $val) 
                                  {         
                                    $meal_plan_arr[] = $this->Hotelcrs_Model->get_hotel_room_meal_plan($val);
                                  }
                                   if(!empty($meal_plan_arr))
                                    {      
                                       $inclusion=implode("<br>", $meal_plan_arr);
                                    }
                                    else
                                    {
                                       $inclusion="";
                                    }   

                                ?>
                                <tr>
                                  <td>
                                    <span class="name"><?php echo $vale->room_name.' ( '.$vale->room_type.' )'; ?></span>
                                  </td>
                                  <td class="hidden-phone"><?php echo $inclusion; ?></td>                               
                                

                                  <td class="hidden-phone">
                                  <?php if($vale->conversation_id=="EARLYBIRD"||$vale->conversation_id=="STAYPAY"||$vale->conversation_id=="DISCOUNT"){ ?>
                <h6><?php echo ' " '.$vale->conversation_id.' "  OFFER APPLIED'; ?> </h6>
                <?php } ?>              
                         <span class="price" style="font-size: 12px;text-align: left;">
                           <?php if($vale->conversation_id=="EARLYBIRD"||$vale->conversation_id=="STAYPAY"||$vale->conversation_id=="DISCOUNT"){ ?>
                            <span class="striked-text"><?php echo $vale->xml_currency . ' ' .round(($vale->net_fare)); ?></span><br>                       
                             <?php } ?>
                            <span class="text-uppercase">Pay Only </span><?php echo $vale->xml_currency . ' ' .round(($vale->total_cost)); ?>
                          </span>
                  
                
                                    <span class="pull-right">
                                   <form name="frmHotelDetails" method="post" action="<?php echo site_url(); ?>hotels/details">
                                  <input type="hidden" name="callBackId" value="<?php echo base64_encode('hotel_crs'); ?>" />
                                  <input type="hidden" name="hotelCode" value="<?php echo $vale->hotel_code; ?>" />
                                  <input type="hidden" name="searchId" value="<?php echo $vale->search_id; ?>" />
                                   <button class="btn btn-danger" data-original-title="" title="">Book</button>
                                   </form>
                                 </span>
                                      
                                     
                                   
                                  </td>
                                </tr>
                                <?php } ?>                              
                              </tbody>
                            </table>
                          </div>