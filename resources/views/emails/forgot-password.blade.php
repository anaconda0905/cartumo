Hey {{ $user->first_name }} kindly change your password.Please click on <a href="{{ route('reset-password') }}?email={{ $user->email }}&code={{ $code }}">this link</a> for changing your passsword

