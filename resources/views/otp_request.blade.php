<html>
    <!-- resources/views/otp_request.blade.php -->
    <form action="{{ route('otp.send') }}" method="POST">
        @csrf
        <input type="text" name="phone_number" placeholder="Enter your phone number" required>
        <button type="submit">Send OTP</button>
    </form>
</html>