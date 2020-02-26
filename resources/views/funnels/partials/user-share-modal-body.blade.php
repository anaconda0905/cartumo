<div class="user-share-modal-body">

    <h2>Share funnel with user</h2>
    <hr>

    <form id="frm_funnel_share_user" class="form" action="{{ route('funnel.share.user') }}" method="POST">

        <div class="form-group">
            <label for="email">Enter user's email to share with</label>
            <input type="email" name="user_email" id="email" class="form-control" placeholder="Type existing user's email address" required>
        </div>

        <button type="submit" class="btn btn-success btn-lg btn-block">Share NOW</button>
    </form>

</div>