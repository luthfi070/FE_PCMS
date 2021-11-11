<div wire:poll class="row">
    <div class="col-12 my-4" style="overflow-y: scroll;">
    @forelse ($messages as $message)
       [{{$message->created_at->format('H:i')}}] {{$message->userFullName()}}: {{$message->message_text}} <br>
    @empty
        Tidak Ada Pesan <br>
    @endforelse

    </div>
    <form wire:submit.prevent="sendMessage" class="row col-12">

    <div class="col-8">
        <input wire:model.defer="messageText" class="form-control" type="text" id="message" placeholder="Masukkan pesan">
    </div>
    <div class="col-4">
        <button class="btn btn-primary">Kirim</button>
    </div>
</form>

</div>