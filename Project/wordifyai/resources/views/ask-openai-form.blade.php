<!-- ask-openai-form.blade.php -->

<form action="/ask-openai" method="POST">
    @csrf
    <label for="message">Enter your message:</label>
    <input type="text" id="message" name="message" value="{{ old('message') }}" required>
    <button type="submit">Send</button>
</form>

@if(isset($answer))
    <div class="mt-3">
        <strong>Response:</strong>
        <p>{!! $answer !!}</p>
    </div>
@endif

@if(isset($error))
    <div class="mt-3 text-danger">
        <strong>Error:</strong>
        <p>{{ $error }}</p>
    </div>
@endif
