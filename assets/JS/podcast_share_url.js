function getPodcastShareUrl(slug) {
    return window.location.origin + window.location.pathname + '?podcast=' + slug;
}

function copyPodcastLink(slug, btn) {
    const shareUrl = getPodcastShareUrl(slug);
    navigator.clipboard.writeText(shareUrl).then(() => {
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check text-xs"></i>';
        btn.classList.remove('text-gray-500', 'hover:text-[#dc3545]');
        btn.classList.add('text-green-500');
        
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.classList.remove('text-green-500');
            btn.classList.add('text-gray-500', 'hover:text-[#dc3545]');
        }, 1500);
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
}

function sharePodcastWhatsApp(slug, title) {
    const text = encodeURIComponent(`Listen to this episode of SONRISE Podcast: "${title}" \n\n Tune in here: ` + getPodcastShareUrl(slug));
    window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
}

function sharePodcastTwitter(slug, title) {
    const text = encodeURIComponent(`Listening to "${title}" on SONRISE Hub! 🎙️`);
    const url = encodeURIComponent(getPodcastShareUrl(slug));
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}
