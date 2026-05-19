/**
 * SONRISE Media Player Core Control Logic
 * Unified System: Handles playback, progress bars, and icon centering adjustments
 */
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

            // Stop all other audio elements currently playing on the page
            document.querySelectorAll("audio").forEach(otherAudio => {
                if (otherAudio !== audioNode && !otherAudio.paused) {
                    otherAudio.pause();
                    
                    // Reset foreign active buttons back to default play states
                    const correspondingBtn = document.querySelector(`[data-episode="${otherAudio.id}"]`);
                    if (correspondingBtn) {
                        const btnIcon = correspondingBtn.querySelector(".btn-icon");
                        if (btnIcon) {
                            btnIcon.classList.remove("fa-pause");
                            btnIcon.classList.add("fa-play");
                            if (btnIcon.classList.contains('text-lg')) {
                                btnIcon.classList.add('ml-0.5'); // Re-apply visual play offset triangle centering
                            }
                        }
                    }
                }
            });

            // Toggle Audio Control State Matrix
            if (!audioNode.paused) {
                audioNode.pause();
                iconNode.classList.remove("fa-pause");
                iconNode.classList.add("fa-play");
                if (iconNode.classList.contains('text-lg')) {
                    iconNode.classList.add('ml-0.5'); // Apply centering alignment
                }
            } else {
                audioNode.play().catch(err => {
                    console.warn("Audio launch blocked or delayed by sandbox policies: ", err);
                });
                iconNode.classList.remove("fa-play");
                iconNode.classList.add("fa-pause");
                iconNode.classList.remove('ml-0.5'); // Remove padding adjustments so pause bars aren't lopsided
            }

            // 2. Continuous Playback Tracking Loop Handler (Attach once per element life-cycle)
            if (!audioNode.dataset.hasTrackingAttached && controlCard) {
                const sliderInput = controlCard.querySelector(".podcast-progress-bar");
                const timeTrackerText = controlCard.querySelector(".current-time-display");
                const durationTrackerText = controlCard.querySelector(".total-duration-display");

                audioNode.addEventListener("timeupdate", () => {
                    if (audioNode.duration) {
                        const progressPct = (audioNode.currentTime / audioNode.duration) * 100;
                        
                        if (sliderInput) {
                            sliderInput.value = progressPct;
                            // Dynamically push a crimson track background fill up behind your slider knob thumb
                            sliderInput.style.background = `linear-gradient(to right, #dc3545 0%, #dc3545 ${progressPct}%, #1f2937 ${progressPct}%, #1f2937 100%)`;
                        }

                        if (timeTrackerText) {
                            timeTrackerText.textContent = formatTimeDisplay(audioNode.currentTime);
                        }
                    }
                });

                // Populate dynamic length values as soon as browser processes file stream buffers
                audioNode.addEventListener("loadedmetadata", () => {
                    if (durationTrackerText) {
                        durationTrackerText.textContent = formatTimeDisplay(audioNode.duration);
                    }
                });

                // Automated System Reset when track runs to completion
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

    // 3. Scrubbing Mechanics: Allow Users to Drag and Click the Bar to Jump Time Positions
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