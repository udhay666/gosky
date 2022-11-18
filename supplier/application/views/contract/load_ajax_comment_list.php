
   <div class="row border_row">
            <table class="table table-custom dt-responsive" cellspacing="0" width="100%" id="tablecomment">
             <thead>           
              <tr> 
                <th>SL. No.</th>               
                <th>Contract Number</th>
                <th>Summary</th>
                <th>Comment</th>
                <th>Update Time</th>
               </tr>             
            </thead>
            <tbody>
              <?php if(!empty($comment_info)){
              for($i=0;$i<count($comment_info);$i++){ ?>
              <tr>             
                <td><?php echo ($i+1); ?></td>
                <td><?php  echo $contract_info->contract_number; ?></td>              
                <td><?php echo $comment_info[$i]->summary; ?></td>
                <td><?php echo $comment_info[$i]->comment; ?></td>
                <td><?php echo $comment_info[$i]->last_updated; ?></td>              
              </tr>
              <?php }} ?>
            </tbody>
          </table>            
        </div> 

<script type="text/javascript">
$(document).ready(function() {
  $('#tablecomment').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [{extend:'pageLength', className: "btn-primary"},{       
                      extend: 'excel',
                      text: 'Export Excel',
                      exportOptions: {
                        rows: { selected: true }                                                
                      },
                      className: "btn-success"
                    }],
                    lengthMenu: [
                    [5, 10, 25, 50, -1 ],
                    ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                    ]
                  });
  });

</script> 




