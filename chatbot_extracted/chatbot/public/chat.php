<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="hero mb-4">
  <div class="row align-items-center">
    <div class="col-md-7">
      <h2 class="mb-2">Butuh informasi layanan Disperindag?</h2>
      <p class="text-muted">Tanyakan seputar UMKM, program, alur layanan, atau minta arahan ke sistem terkait. Bot ini adalah gerbang informasi terpadu.</p>
      <div class="mt-3">
        <div class="chip" id="startChat">Mulai Chat</div>
        <div class="chip" onclick="location.href='/chatbot/public/index.php'">Kembali ke Beranda</div>
      </div>
    </div>
    <div class="col-md-5 text-center d-none d-md-block">
      <div class="brand-badge mx-auto mb-2"><i class="bi bi-people-fill"></i></div>
      <small class="text-muted">Layanan 24/7 · Panduan & Navigasi Sistem</small>
    </div>
  </div>
</div>

<div class="chat-shell">
  <div class="chat-side">
    <div class="card p-3 mb-3">
      <h6 class="mb-2">Topik Populer</h6>
      <div class="d-flex flex-column">
        <div class="chip" data-flow="umkm">Pendataan UMKM</div>
        <div class="chip" data-flow="pengaduan">Cara Pengaduan</div>
        <div class="chip" data-flow="harga">Harga Pasar</div>
        <div class="chip" data-flow="kontak">Kontak Disperindag</div>
      </div>
    </div>
    <div class="card p-3">
      <h6>Alur Bertahap</h6>
      <ol class="ps-3 feature-list">
        <li>Pilih topik atau tulis pertanyaan</li>
        <li>Bot menjawab dari database FAQ</li>
        <li>Jika tidak terjawab → eskalasi ke admin</li>
      </ol>
    </div>
  </div>

  <div class="chat-window">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
      <div>
        <strong>Chatbot Disperindag</strong>
        <div class="text-muted small">Pelayanan informasi & navigasi</div>
      </div>
      <div class="text-muted small">Status: <span class="text-success">Online</span></div>
    </div>
    <div id="chatBox"></div>
    <div class="p-3 border-top">
      <div id="quickArea" class="quick-replies mb-2"></div>
      <div class="input-group">
        <input id="msg" class="form-control" placeholder="Tanyakan sesuatu...">
        <button id="sendBtn" class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>

<script>
// UI wiring: uses window.chatUI from assets
(function(){
  const sendBtn = document.getElementById('sendBtn');
  const msg = document.getElementById('msg');
  const quickArea = document.getElementById('quickArea');

  function sessionKey(){
    let k = localStorage.getItem('chat_session');
    if(!k){ k = 's_'+Math.random().toString(36).slice(2,10); localStorage.setItem('chat_session',k); }
    return k;
  }

  function sendMessage(text){
    window.chatUI.appendMessage('user', text);
    window.chatUI.showTyping();
    fetch('/chatbot/api/chat_api.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({message:text, session: sessionKey()})
    }).then(r=>r.json()).then(j=>{
      window.chatUI.hideTyping();
      window.chatUI.appendMessage('bot', j.answer || 'Maaf, belum ada jawaban.');
      renderQuickReplies(j);
    }).catch(e=>{ window.chatUI.hideTyping(); window.chatUI.appendMessage('bot','Terjadi kesalahan.'); });
  }

  function renderQuickReplies(res){
    quickArea.innerHTML='';
    const samples = ['Bagaimana mendaftar UMKM?','Kontak Disperindag','Program pembinaan UMKM'];
    samples.forEach(s=>{
      const c = document.createElement('div'); c.className='chip'; c.innerText=s;
      c.onclick = ()=> sendMessage(s);
      quickArea.appendChild(c);
    });
  }

  sendBtn.onclick = ()=>{ const v=msg.value.trim(); if(!v) return; sendMessage(v); msg.value=''; msg.focus(); };
  document.querySelectorAll('.chip[data-flow]').forEach(b=>{ b.onclick = ()=> sendMessage(b.dataset.flow); });
  document.getElementById('startChat').onclick = ()=> sendMessage('Halo, saya butuh informasi');

  // initial greeting
  window.chatUI.appendMessage('bot','Halo! Selamat datang di layanan informasi Disperindag Jateng. Ada yang bisa kami bantu?');
  renderQuickReplies();
})();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>