class HapticFeedback {
  private ctx: AudioContext | null = null;
  private init() {
    if (!this.ctx) {
      const AudioCtx = window.AudioContext || (window as any).webkitAudioContext;
      if (AudioCtx) this.ctx = new AudioCtx();
    }
  }
  playPop() {
    try {
      this.init();
      if (!this.ctx) return;
      if (this.ctx.state === 'suspended') this.ctx.resume();
      const osc = this.ctx.createOscillator();
      const gain = this.ctx.createGain();
      osc.type = 'sine';
      osc.frequency.setValueAtTime(440, this.ctx.currentTime);
      osc.frequency.exponentialRampToValueAtTime(120, this.ctx.currentTime + 0.04);
      gain.gain.setValueAtTime(0.12, this.ctx.currentTime);
      gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + 0.04);
      osc.connect(gain);
      gain.connect(this.ctx.destination);
      osc.start();
      osc.stop(this.ctx.currentTime + 0.04);
    } catch (_) {}
  }
}

// Discord User ID Lifianzhi
const DISCORD_USER_ID = "805207928612061244";

async function fetchLiveSpotify() {
  const titleEl = document.getElementById('sp-title');
  const artistEl = document.getElementById('sp-artist');
  const statusEl = document.getElementById('sp-status');
  const eqEl = document.getElementById('sp-eq');
  const cardEl = document.getElementById('spotify-link') as HTMLAnchorElement | null;
  const albumImg = document.getElementById('sp-album-art') as HTMLImageElement | null;
  const defaultIcon = document.getElementById('sp-icon-default');

  if (!titleEl || !artistEl || !statusEl || !eqEl) return;

  try {
    const res = await fetch(`https://api.lanyard.rest/v1/users/${DISCORD_USER_ID}`);
    const json = await res.json();

    if (json.success && json.data.listening_to_spotify) {
      const sp = json.data.spotify;
      titleEl.textContent = sp.song;
      artistEl.textContent = sp.artist;
      statusEl.textContent = "NOW LISTENING (LIVE)";
      eqEl.style.display = "flex";

      if (albumImg && sp.album_art_url) {
        albumImg.src = sp.album_art_url;
        albumImg.style.display = "block";
        if (defaultIcon) defaultIcon.style.display = "none";
      }
      if (cardEl && sp.track_id) {
        cardEl.href = `https://open.spotify.com/track/${sp.track_id}`;
      }
    } else {
      statusEl.textContent = "OFFLINE / IDLE";
      eqEl.style.display = "none";
      if (albumImg) albumImg.style.display = "none";
      if (defaultIcon) defaultIcon.style.display = "flex";
      titleEl.textContent = "Cincin";
      artistEl.textContent = "Hindia (Favorite)";
      if (cardEl) cardEl.href = "https://open.spotify.com";
    }
  } catch (err) {
    console.error("Lanyard Spotify sync error:", err);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const haptic = new HapticFeedback();

  // Tactile sound effect
  document.querySelectorAll<HTMLElement>('.dock-item, .spotify-card, .mini-card, .simple-card, .btn-copy, .cli-box').forEach(el => {
    el.addEventListener('mousedown', () => haptic.playPop());
  });

  // CLI Accordion
  const cliBox = document.getElementById('cli-toggle');
  const cliDetails = document.getElementById('cli-details');
  if (cliBox && cliDetails) {
    cliBox.addEventListener('click', () => {
      cliDetails.style.display = cliDetails.style.display === 'none' ? 'block' : 'none';
    });
  }

  // Real-time Clock (Semarang WIB)
  const clockElement = document.getElementById('live-clock');
  const updateClock = () => {
    if (!clockElement) return;
    const now = new Date();
    clockElement.textContent = `Semarang • ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })} WIB`;
  };
  updateClock();
  setInterval(updateClock, 1000);

  // Copy Profile URL
  const copyBtn = document.getElementById('btn-copy-url');
  if (copyBtn) {
    copyBtn.addEventListener('click', async () => {
      try {
        await navigator.clipboard.writeText(window.location.origin);
        const original = copyBtn.innerText;
        copyBtn.innerText = '✓ URL COPIED';
        setTimeout(() => copyBtn.innerText = original, 2000);
      } catch (err) {}
    });
  }

  // Poll Spotify Status secara berkala (setiap 5 detik)
  fetchLiveSpotify();
  setInterval(fetchLiveSpotify, 5000);
});
