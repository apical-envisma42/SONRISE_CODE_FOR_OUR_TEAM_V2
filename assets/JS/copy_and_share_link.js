// // 1. Copy Link to Clipboard
// function copyPoemLink(slug, btn) {
//     const shareUrl = window.location.origin + window.location.pathname + '?poem=' + slug;
    
//     navigator.clipboard.writeText(shareUrl).then(() => {
//         const originalIcon = btn.innerHTML;
//         btn.innerHTML = '<i class="fa-solid fa-check"></i>';
//         btn.style.background = "#28a745";
//         btn.style.color = "white";
        
//         setTimeout(() => {
//             btn.innerHTML = originalIcon;
//             btn.style.background = "";
//             btn.style.color = "";
//         }, 2000);
//     });
// }

// // 2. WhatsApp Share
// function shareWhatsApp(slug, title) {
//     const shareUrl = window.location.origin + window.location.pathname + '?poem=' + slug;
//     const text = encodeURIComponent(`Check out this poem: "${title}" \n\n Read it here: ` + shareUrl);
//     window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
// }

// // 3. Facebook Share
// function shareFacebook(slug) {
//     const shareUrl = window.location.origin + window.location.pathname + '?poem=' + slug;
//     window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`, '_blank');
// }


// Function to generate the clean link
function getShareUrl(slug) {
    return window.location.origin + window.location.pathname + '?poem=' + slug;
}
function copyPoemLink(slug, btn) {
    const shareUrl = getShareUrl(slug);
    navigator.clipboard.writeText(shareUrl).then(() => {
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        btn.style.background = "#28a745";
        btn.style.color = "#dc3545";
        
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.style.background = "";
            btn.style.color = "";
        }, 1150);
    });
}

// 2. WhatsApp
function shareWhatsApp(slug, title) {
    const text = encodeURIComponent(`"${title}" - Read this beautiful poem at Son-rize: ` + getShareUrl(slug));
    window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
}

// 3. Twitter (X)
function shareTwitter(slug, title) {
    const text = encodeURIComponent(`Check out this poem on Son-rize: "${title}"`);
    const url = encodeURIComponent(getShareUrl(slug));
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}

// 4. Gmail
function shareGmail(slug, title) {
    const subject = encodeURIComponent(`Poem Recommendation: ${title}`);
    const body = encodeURIComponent(`I found this poem on Son-rize and thought you'd like it:\n\n${getShareUrl(slug)}`);
    window.location.href = `mailto:?subject=${subject}&body=${body}`;
}

