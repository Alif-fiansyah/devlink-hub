interface ApiResponse {
  status: 'success' | 'error';
  message?: string;
  data?: any;
}

document.addEventListener('DOMContentLoaded', () => {
  // 1. Telemetri Klik Link di Halaman Publik
  const linkElements = document.querySelectorAll<HTMLAnchorElement>('.link-item');
  linkElements.forEach((link) => {
    link.addEventListener('click', async () => {
      const linkId = link.getAttribute('data-id');
      if (linkId) {
        try {
          await fetch('/api.php?action=click', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: Number(linkId) }),
          });
        } catch (e) {
          console.error('Failed to log click metric', e);
        }
      }
    });
  });

  // 2. Tombol Salin URL
  const shareBtn = document.getElementById('share-btn');
  if (shareBtn) {
    shareBtn.addEventListener('click', async () => {
      try {
        await navigator.clipboard.writeText(window.location.origin);
        const originalText = shareBtn.innerText;
        shareBtn.innerText = 'Link Tersalin!';
        setTimeout(() => {
          shareBtn.innerText = originalText;
        }, 2000);
      } catch (err) {
        console.error('Failed to copy', err);
      }
    });
  }

  // 3. Logika Form Tambah Link di Admin Panel
  const addForm = document.getElementById('add-link-form') as HTMLFormElement | null;
  if (addForm) {
    addForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const titleInput = document.getElementById('in-title') as HTMLInputElement;
      const urlInput = document.getElementById('in-url') as HTMLInputElement;
      const descInput = document.getElementById('in-desc') as HTMLInputElement;

      const payload = {
        title: titleInput.value.trim(),
        url: urlInput.value.trim(),
        description: descInput.value.trim(),
      };

      const res = await fetch('/api.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });

      const json: ApiResponse = await res.json();
      if (json.status === 'success') {
        window.location.reload();
      } else {
        alert(json.message || 'Gagal menambahkan link');
      }
    });
  }

  // 4. Logika Tombol Hapus Link
  const deleteButtons = document.querySelectorAll<HTMLButtonElement>('.btn-del');
  deleteButtons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const id = btn.getAttribute('data-id');
      if (id && confirm('Hapus tautan ini?')) {
        const res = await fetch('/api.php?action=delete', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id: Number(id) }),
        });
        const json: ApiResponse = await res.json();
        if (json.status === 'success') {
          btn.closest('tr')?.remove();
        }
      }
    });
  });
});
