<div class="page-header">
  <h2>List of Companies</h2>
</div>


<div class="row">
  <div class="span6">
    <table >
      <tbody>

        <?php foreach($companies as $comp){ ?>
          <tr>
            <td><img class="" src="http://placehold.it/260x180" alt="" width="80" align="left" style="padding: 0px 5px 5px 0px"></td>
            <td><h5><?php echo $comp['company_name'];?></h5>
            <p></p>
            </td>
            <td>
              
            </td>
          </tr>
          
        <?php } ?>
      </tbody>
    </table>
    
  </div>
</div>