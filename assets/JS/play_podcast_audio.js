document.addEventListener("DOMContentLoaded", () => {
    const playButtons = document.querySelectorAll(".podcast-btn");
    const progressBars = document.querySelectorAll(".podcast-progress-bar");

    // Helper Utility: Convert seconds directly into standard 00:00 notation safely
    function formatTimeDisplay(seconds) {
        if (isNaN(seconds) || !isFinite(seconds)) return "00:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return (mins < 10 ? "0" : "") + mins + ":" + (secs < 10 ? "0" : "") + secs;
    }

    // 1. Monitor Play/Pause Clicks Across All Dynamic Cards
    playButtons.forEach(button => {
        button.addEventListener("click", () => {
            const audioId = button.getAttribute("data-episode");
            const audioNode = document.getElementById(audioId);
            const iconNode = button.querySelector(".btn-icon");
            
            // Fixed: Safely capture the direct dark wrapper block containing slider nodes
            const controlCard = button.closest(".bg-gray-950");

            if (!audioNode) {
                console.error("Target audio node element missing in DOM:", audioId);
                return;
            }

            document.querySelectorAll("audio").forEach(otherAudio => {
                if (otherAudio !== audioNode && !otherAudio.paused) {
                    otherAudio.pause();
                    
                    const correspondingBtn = document.querySelector(`[data-episode="${otherAudio.id}"]`);
                    if (correspondingBtn) {
                        const btnIcon = correspondingBtn.querySelector(".btn-icon");
                        if (btnIcon) {
                            btnIcon.classList.remove("fa-pause");
                            btnIcon.classList.add("fa-play");
                            if (btnIcon.classList.contains('text-lg')) {
                                btnIcon.classList.add('ml-0.5'); 
                            }
                        }
                    }
                }
            });

            if (!audioNode.paused) {
                audioNode.pause();
                iconNode.classList.remove("fa-pause");
                iconNode.classList.add("fa-play");
                if (iconNode.classList.contains('text-lg')) {
                    iconNode.classList.add('ml-0.5');
                }
            } else {
                audioNode.play().catch(err => {
                    console.warn("Audio launch blocked or delayed by sandbox policies: ", err);
                });
                iconNode.classList.remove("fa-play");
                iconNode.classList.add("fa-pause");
                iconNode.classList.remove('ml-0.5');
            }

            if (!audioNode.dataset.hasTrackingAttached && controlCard) {
                const sliderInput = controlCard.querySelector(".podcast-progress-bar");
                const timeTrackerText = controlCard.querySelector(".current-time-display");
                const durationTrackerText = controlCard.querySelector(".total-duration-display");

                audioNode.addEventListener("timeupdate", () => {
                    if (audioNode.duration) {
                        const progressPct = (audioNode.currentTime / audioNode.duration) * 100;
                        
                        if (sliderInput) {
                            sliderInput.value = progressPct;
                            sliderInput.style.background = `linear-gradient(to right, #dc3545 0%, #dc3545 ${progressPct}%, #1f2937 ${progressPct}%, #1f2937 100%)`;
                        }

                        if (timeTrackerText) {
                            timeTrackerText.textContent = formatTimeDisplay(audioNode.currentTime);
                        }
                    }
                });

                audioNode.addEventListener("loadedmetadata", () => {
                    if (durationTrackerText) {
                        durationTrackerText.textContent = formatTimeDisplay(audioNode.duration);
                    }
                });

                audioNode.addEventListener("ended", () => {
                    iconNode.classList.remove("fa-pause");
                    iconNode.classList.add("fa-play");
                    if (iconNode.classList.contains('text-lg')) {
                        iconNode.classList.add('ml-0.5');
                    }
                    if (sliderInput) {
                        sliderInput.value = 0;
                        sliderInput.style.background = "#1f2937";
                    }
                    if (timeTrackerText) {
                        timeTrackerText.textContent = "00:00";
                    }
                });

                audioNode.dataset.hasTrackingAttached = "true";
            }
        });
    });

    progressBars.forEach(bar => {
        const targetAudioId = bar.getAttribute("data-target");
        const targetAudio = document.getElementById(targetAudioId);

        if (!targetAudio) return;

        const updateAudioPosition = () => {
            if (targetAudio.duration) {
                const seekToSeconds = (bar.value / 100) * targetAudio.duration;
                targetAudio.currentTime = seekToSeconds;
            }
        };

        bar.addEventListener("input", updateAudioPosition);
        bar.addEventListener("change", updateAudioPosition);
    });
});