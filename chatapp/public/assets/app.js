// Enhanced chat UI behavior: session, typing, quick replies
(function(){
	console.log('Chatbot assets loaded');
	// utility to format time
	function timeNow(){
		const d=new Date(); return d.toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'});
	}

	// expose for chat page
	window.chatUI = {
		appendMessage(role, text, opts={}){
			const chatBox = document.getElementById('chatBox');
			if(!chatBox) return;
			const wrap = document.createElement('div');
			wrap.className = role === 'user' ? 'd-flex justify-content-end mb-2' : 'd-flex mb-2';
			const bubble = document.createElement('div');
			bubble.className = 'msg ' + (role==='user'?'user':'bot');
			bubble.innerHTML = text + '<span class="meta">'+(opts.time||timeNow())+'</span>';
			wrap.appendChild(bubble);
			chatBox.appendChild(wrap);
			chatBox.scrollTop = chatBox.scrollHeight;
		},
		showTyping(){
			const chatBox = document.getElementById('chatBox');
			if(!chatBox) return;
			const t = document.createElement('div'); t.id='__typing'; t.className='d-flex mb-2';
			const bubble = document.createElement('div'); bubble.className='msg bot';
			bubble.innerHTML = '<span class="typing"></span>';
			t.appendChild(bubble); chatBox.appendChild(t); chatBox.scrollTop = chatBox.scrollHeight;
		},
		hideTyping(){ const t = document.getElementById('__typing'); if(t) t.remove(); }
	};
})();
