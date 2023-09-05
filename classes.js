class DayManager {
    _currentHours;
    // _currentWeather

    constructor(currentHours) {
        this._currentHours = currentHours;
        // this._currentWeather = currentWeather;
    }

    getDayStyleClassName() {
        if (this._currentHours >= 22 || this._currentHours >= 0 && this._currentHours < 5) {
            return "night";
        }
        else if (this._currentHours >= 5 && this._currentHours < 9) {
            return "morning";
        }
        else if (this._currentHours >= 9 && this._currentHours < 16) {
            return "day";
        }
        else if (this._currentHours >= 16 && this._currentHours < 19) {
            return "evening";
        }
        else {
            return "late-evening";
        }
    }
}