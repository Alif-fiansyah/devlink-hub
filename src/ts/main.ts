interface LinkPayload {
  id?: number;
  title: string;
  url: string;
  description: string;
}

document.addEventListener('DOMContentLoaded', () => {
  // 1. Theme Switcher Logic
  const savedTheme = localStorage.getItem('devlink_theme') || 'slate';
  document.documentElement.setAttribute('data-theme', savedTheme);

  document.querySelectorAll<HTMLButtonElement>('[data-set-theme]').forEach(btn => {
    btn.addEventListener('click', () => {
      const theme = btn.getAttribute('data-set-theme') || 'slate';
      document.documentElement.setAttribute('data-theme', theme);
      localStorage.setItem('devlink_theme', theme);
    });
  });

  // 2. Share / Copy Link
  const shareBtn = document.getElementById('share-btn');
  if (shareBtn) {
    shareBtn.addEventListener('click', async () => {
      try {
        await navigator.clipboard.writeText(window.location.href);
        const orig = shareBtn.innerText;
        shareBtn.innerText = 'Link Disalin!';
        setTimeout(() => (shareBtn.innerText = orig), 2000);
      } catch (e) {
        console.error(e);
      }
    });
  }

  // 3. Telemetry Click Tracking
  document.querySelectorAll<HTMLAnchorElement>('.link-item').forEach(link => {
    link.addEventListener('click', () => {
      const id = link.dataset.id;
      if (id) {
        navigator.sendBeacon(`/api.php?action=click`, JSON.stringify({ id: Number(id) }));
      }
    });
  });

  // 4. Live Reactive Phone Preview (Admin Mode)
  const titleInput = document.getElementById('in-title') as HTMLInputElement | null;
  const descInput = document.getElementById('in-desc') as HTMLInputElement | null;
  const livePreviewCard = document.getElementById('mockup-live-card');

  if (titleInput && livePreviewCard) {
    const updatePreview = () => {
      const title = titleInput.value.trim() || 'Judul Baru Preview';
      const desc = descInput?.value.trim() || 'Deskripsi link akan tampil di sini';
      livePreviewCard.innerHTML = `
        <div class="link-info">
          <span class="title">${title}</span>
          <span class="desc">${desc}</span>
        </div>
        <span class="link-arrow">→</span>
      `;
    };

    titleInput.addEventListener('input', updatePreview);
    descInput?.addEventListener('input', updatePreview);
  }

  // 5. Admin Form Submission (Async API)
  const form = document.getElementById('add-link-form') as HTMLFormElement | null;
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const inTitle = (document.getElementById('in-title') as HTMLInputElement).value;
      const inUrl = (document.getElementById('in-url') as HTMLInputElement).value;
      const inDesc = (document.getElementById('in-desc') as HTMLInputElement).value;

      const res = await fetch('/api.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title: inTitle, url: inUrl, description: inDesc })
      });

      const data = await res.json();
      if (data.status === 'success') {
        window.location.reload();
      } else {
        alert(data.message || 'Gagal menyimpan');
      }
    });
  }

  // 6. Delete Action
  document.querySelectorAll<HTMLButtonElement>('.btn-del').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (id && confirm('Hapus tautan ini?')) {
        const res = await fetch('/api.php?action=delete', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id: Number(id) })
        });
        const data = await res.json();
        if (data.status === 'success') {
          btn.closest('tr')?.remove();
        }
      }
    });
  });
});
