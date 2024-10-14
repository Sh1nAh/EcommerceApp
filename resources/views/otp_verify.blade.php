<!-- resources/views/otp_verify.blade.php -->
<form action="{{ route('otp.verify') }}" method="POST">
    @csrf
    <input type="text" name="otp" placeholder="Enter your OTP" required>
    <input type="hidden" name="phone_number" value="{{ $phone_number }}">
    <button type="submit">Verify OTP</button>
</form>
