<!-- Modal -->
<div id="modalConfirm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete <span class="modal-resource-name"></span></h4>
        </div>
        <div class="modal-body">
            <p style="text-align:center; margin-bottom:20px;">
                <b>Do you really want to delete this <span class="modal-resource-name"></span>?</b>
            </p>

            <p>
                <form method="post" action="" id="frmDeleteResource" style="text-align:center;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-success" id="btnDelete" style="margin-right:15px;">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </form>
            </p>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>

  </div>
</div>