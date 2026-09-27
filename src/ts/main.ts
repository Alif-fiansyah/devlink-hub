class HapticFeedback {
  private ctx: AudioContext | null = null;
  private init() {
    if (!this.ctx) {
      const AudioCtx = window.AudioContext || (window as any).webkitAudioContext;
      if (AudioCtx) this.ctx = new AudioCtx();
    }
  }
  playTone(freq: number = 440, type: OscillatorType = 'sine') {
    try {
      this.init();
      if (!this.ctx) return;
      if (this.ctx.state === 'suspended') this.ctx.resume();
      const osc = this.ctx.createOscillator();
      const gain = this.ctx.createGain();
      osc.type = type;
      osc.frequency.setValueAtTime(freq, this.ctx.currentTime);
      osc.frequency.exponentialRampToValueAtTime(freq / 2, this.ctx.currentTime + 0.05);
      gain.gain.setValueAtTime(0.15, this.ctx.currentTime);
      gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + 0.05);
      osc.connect(gain);
      gain.connect(this.ctx.destination);
      osc.start();
      osc.stop(this.ctx.currentTime + 0.05);
    } catch (_) {}
  }
}

const DISCORD_USER_ID = "805207928612061244";

// 1. Spotify Live Polling
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
  } catch (err) {}
}

// 2. Fetch Latest Pushed GitHub Repository
async function fetchLatestRepo() {
  const repoNameEl = document.getElementById('latest-repo-name');
  const repoDescEl = document.getElementById('latest-repo-desc');
  const repoLink = document.getElementById('latest-repo-link') as HTMLAnchorElement | null;

  try {
    const res = await fetch('https://api.github.com/users/Alif-fiansyah/repos?sort=pushed&per_page=1');
    const repos = await res.json();
    if (repos && repos.length > 0) {
      const r = repos[0];
      if (repoNameEl) repoNameEl.textContent = r.name;
      if (repoDescEl) repoDescEl.textContent = r.language ? `★ ${r.language}` : "Updated recently";
      if (repoLink) repoLink.href = r.html_url;
    }
  } catch (e) {}
}

// 3. Global SQLite Reactions Sync
async function initReactions(haptic: HapticFeedback) {
  const reactionTypes = [
    { id: 'vibe-coffee', type: 'coffee', tone: 520 },
    { id: 'vibe-arch', type: 'arch', tone: 660 },
    { id: 'vibe-fire', type: 'fire', tone: 800 }
  ];

  try {
    const res = await fetch('api-reactions.php');
    const data = await res.json();
    reactionTypes.forEach(r => {
      const countEl = document.querySelector(`#${r.id} .count`);
      if (countEl && data[r.type] !== undefined) {
        countEl.textContent = `${data[r.type]}`;
      }
    });
  } catch (e) {}

  reactionTypes.forEach(r => {
    const btn = document.getElementById(r.id);
    const countEl = btn?.querySelector('.count');
    if (!btn || !countEl) return;

    btn.addEventListener('click', async () => {
      haptic.playTone(r.tone, 'triangle');
      try {
        const res = await fetch('api-reactions.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ type: r.type })
        });
        const json = await res.json();
        if (json.count !== undefined) {
          countEl.textContent = `${json.count}`;
        }
      } catch (e) {}
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const haptic = new HapticFeedback();

  // Button pop sounds
  document.querySelectorAll<HTMLElement>('.dock-item, .spotify-card, .mini-card, .pill-btn, .btn-copy, .cli-box').forEach(el => {
    el.addEventListener('mousedown', () => haptic.playTone(380, 'sine'));
  });

  // CLI Accordion
  const cliBox = document.getElementById('cli-toggle');
  const cliDetails = document.getElementById('cli-details');
  if (cliBox && cliDetails) {
    cliBox.addEventListener('click', () => {
      cliDetails.style.display = cliDetails.style.display === 'none' ? 'block' : 'none';
    });
  }

  // Dotfiles One-Click Copy
  const dotfilesBtn = document.getElementById('btn-copy-dotfiles');
  if (dotfilesBtn) {
    dotfilesBtn.addEventListener('click', async () => {
      try {
        await navigator.clipboard.writeText("https://github.com/Alif-fiansyah/dotfiles");
        const hint = dotfilesBtn.querySelector('.action-hint');
        if (hint) {
          const original = hint.textContent;
          hint.textContent = "COPIED! ✓";
          setTimeout(() => hint.textContent = original, 2000);
        }
      } catch (e) {}
    });
  }

  // Real-time Clock
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
        copyBtn.innerText = '✓ URL COPIED';
        setTimeout(() => copyBtn.innerText = 'copy profile url', 2000);
      } catch (err) {}
    });
  }

  fetchLiveSpotify();
  setInterval(fetchLiveSpotify, 5000);
  fetchLatestRepo();
  initReactions(haptic);
});
