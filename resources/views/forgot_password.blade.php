<!-- resources/views/forgot_password.blade.php -->
<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <input type="text" name="phone_number" placeholder="Enter your phone number" required>
    <button type="submit">Send Reset OTP</button>
</form>
