<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded">
    
    <div class="mb-8">
       <livewire:search />
    </div>

    <div class="mb-8">
        <h3>Chat with AfriWise AI</h3>
        <div id="chatbox" class="h-64 overflow-y-auto border p-4 mb-4 bg-gray-100 rounded"></div>
        <div class="flex">
            <input type="text" id="UserMessage" class="flex-grow border border-gray-300 p-2 rounded mr-2" placeholder="Ask anything about Africa">
            <button onclick="sendMessage()" class="bg-blue-500 text-white py-2 px-4 rounded"> 
                Send
            </button>
        </div>
    </div>
</div>

