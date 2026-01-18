// hijri.js — version simplifiée
var HijriJS = (function () {
    function pad(n) {
        return n < 10 ? '0' + n : n;
    }

    function isLeapHijri(year) {
        return ((11 * year + 14) % 30) < 11;
    }

    function toHijri(gY, gM, gD) {
        let jd = gregorianToJD(gY, gM, gD);
        return jdToHijri(jd);
    }

    function toGregorian(hY, hM, hD) {
        let jd = hijriToJD(hY, hM, hD);
        return jdToGregorian(jd);
    }

    function gregorianToJD(year, month, day) {
        return (
            Math.floor((1461 * (year + 4800 + Math.floor((month - 14) / 12))) / 4) +
            Math.floor((367 * (month - 2 - 12 * Math.floor((month - 14) / 12))) / 12) -
            Math.floor((3 * Math.floor((year + 4900 + Math.floor((month - 14) / 12)) / 100)) / 4) +
            day - 32075
        );
    }

    function jdToGregorian(jd) {
        let l = jd + 68569;
        let n = Math.floor((4 * l) / 146097);
        l = l - Math.floor((146097 * n + 3) / 4);
        let i = Math.floor((4000 * (l + 1)) / 1461001);
        l = l - Math.floor((1461 * i) / 4) + 31;
        let j = Math.floor((80 * l) / 2447);
        let day = l - Math.floor((2447 * j) / 80);
        l = Math.floor(j / 11);
        let month = j + 2 - 12 * l;
        let year = 100 * (n - 49) + i + l;
        return { year: year, month: month, day: day };
    }

    function jdToHijri(jd) {
        let jdEpoch = 1948439.5;
        let days = jd - jdEpoch;
        let hYear = Math.floor((30 * days + 10646) / 10631);
        let hMonth = Math.min(12, Math.ceil((days - hijriToJD(hYear, 1, 1) + 1) / 29.5));
        let hDay = jd - hijriToJD(hYear, hMonth, 1) + 1;
        return {
            year: hYear,
            month: hMonth,
            day: Math.floor(hDay)
        };
    }

    function hijriToJD(year, month, day) {
        return (
            day +
            Math.ceil(29.5 * (month - 1)) +
            (year - 1) * 354 +
            Math.floor((3 + 11 * year) / 30) +
            1948440 - 1
        );
    }

    function Gregorian(year, month, day) {
        this.year = year;
        this.month = month;
        this.day = day;

        this.toHijri = function () {
            return toHijri(this.year, this.month, this.day);
        };
    }

    return {
        Gregorian: Gregorian,
        toHijri: toHijri,
        toGregorian: toGregorian
    };
})();
