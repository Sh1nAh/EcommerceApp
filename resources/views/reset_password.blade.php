<!-- resources/views/reset_password.blade.php -->
<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="phone_number" value="{{ $phone_number }}">
    <input type="password" name="new_password" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
</form>
