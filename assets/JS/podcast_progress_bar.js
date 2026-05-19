(function() {
window.addEventListener("DOMContentLoaded", () => {
const triggers = document.querySelectorAll(".podcast-btn");
const timelineSliders = document.querySelectorAll(".podcast-progress-bar");

console.log("Media System Check: Located " + triggers.length + " active streaming buttons on page.");

function convertSecondsToClockString(seconds) {
    if (isNaN(seconds) || !isFinite(seconds)) return "00:00";
    const calculatedMinutes = Math.floor(seconds / 60);
    const calculatedSeconds = Math.floor(seconds % 60);
    return (calculatedMinutes < 10 ? "0" : "") + calculatedMinutes + ":" + 
            (calculatedSeconds < 10 ? "0" : "") + calculatedSeconds;
}

triggers.forEach(button => {
    button.addEventListener("click", (event) => {
        event.preventDefault();
        
        const episodeIdRef = button.getAttribute("data-episode");
        const nativeAudioNode = document.getElementById(episodeIdRef);
        const buttonIconElement = button.querySelector(".btn-icon");
        const dynamicControlCardParent = button.closest(".bg-gray-950") || button.parentElement.parentElement;

        console.log("Click Event Fired! Target Stream ID Pin: " + episodeIdRef);

        if (!nativeAudioNode) {
            console.error("Linkage Error: Audio tag matching ID '" + episodeIdRef + "' is missing inside HTML markup.");
            return;
        }

        document.querySelectorAll("audio").forEach(runningAudioTrack => {
            if (runningAudioTrack !== nativeAudioNode && !runningAudioTrack.paused) {
                runningAudioTrack.pause();
                const twinButtonMatch = document.querySelector(`[data-episode="${runningAudioTrack.id}"]`);
                if (twinButtonMatch) {
                    const foreignIconNode = twinButtonMatch.querySelector(".btn-icon");
                    if (foreignIconNode) foreignIconNode.className = "fa-solid fa-play ml-0.5 text-lg btn-icon";
                }
            }
        });

        if (!nativeAudioNode.paused) {
            nativeAudioNode.pause();
            if (buttonIconElement) buttonIconElement.className = "fa-solid fa-play ml-0.5 text-lg btn-icon";
        } else {
            nativeAudioNode.play().catch(playbackFailureError => {
                console.warn("Media streaming initialization was intercepted by sandbox execution criteria:", playbackFailureError);
            });
            if (buttonIconElement) buttonIconElement.className = "fa-solid fa-pause text-lg btn-icon";
        }

        if (!nativeAudioNode.dataset.hasAttachedTimelineEngine && dynamicControlCardParent) {
            const progressTrackBar = dynamicControlCardParent.querySelector(".podcast-progress-bar");
            const runtimeTimeClockDisplay = dynamicControlCardParent.querySelector(".current-time-display");
            const absoluteLengthClockDisplay = dynamicControlCardParent.querySelector(".total-duration-display");

            nativeAudioNode.addEventListener("timeupdate", () => {
                if (nativeAudioNode.duration) {
                    const activePlaybackPercentage = (nativeAudioNode.currentTime / nativeAudioNode.duration) * 100;
                    
                    if (progressTrackBar) {
                        progressTrackBar.value = activePlaybackPercentage;
                        progressTrackBar.style.background = `linear-gradient(to right, #dc3545 0%, #dc3545 ${activePlaybackPercentage}%, #1f2937 ${activePlaybackPercentage}%, #1f2937 100%)`;
                    }
                    if (runtimeTimeClockDisplay) {
                        runtimeTimeClockDisplay.textContent = convertSecondsToClockString(nativeAudioNode.currentTime);
                    }
                }
            });

            nativeAudioNode.addEventListener("loadedmetadata", () => {
                if (absoluteLengthClockDisplay) {
                    absoluteLengthClockDisplay.textContent = convertSecondsToClockString(nativeAudioNode.duration);
                }
            });

            nativeAudioNode.addEventListener("ended", () => {
                if (buttonIconElement) buttonIconElement.className = "fa-solid fa-play ml-0.5 text-lg btn-icon";
                if (progressTrackBar) {
                    progressTrackBar.value = 0;
                    progressTrackBar.style.background = "#1f2937";
                }
                if (runtimeTimeClockDisplay) runtimeTimeClockDisplay.textContent = "00:00";
            });

            nativeAudioNode.dataset.hasAttachedTimelineEngine = "true";
        }
    });
});

timelineSliders.forEach(sliderBar => {
    const correspondingAudioId = sliderBar.getAttribute("data-target");
    const targetAudioNodeInstance = document.getElementById(correspondingAudioId);

    if (!targetAudioNodeInstance) return;

    const updatePlaybackPositionByScrub = () => {
        if (targetAudioNodeInstance.duration) {
            targetAudioNodeInstance.currentTime = (sliderBar.value / 100) * targetAudioNodeInstance.duration;
        }
    };

    sliderBar.addEventListener("input", updatePlaybackPositionByScrub);
    sliderBar.addEventListener("change", updatePlaybackPositionByScrub);
});
});
})();
