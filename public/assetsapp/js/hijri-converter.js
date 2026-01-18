function toHijri(gDate) {
    const jd = Math.floor((gDate - new Date(622, 6, 16)) / 86400000) + 1948439;
    const islamicEpoch = 1948439;
    let days = jd - islamicEpoch;

    let year = Math.floor((30 * days + 10646) / 10631);
    let month = Math.min(11, Math.ceil((days - 29 - hijriToJDN(year, 1, 1)) / 29.5));
    let day = Math.round(jd - hijriToJDN(year, month + 1, 1) + 1);

    return { year, month: month + 1, day };
}

function hijriToJDN(year, month, day) {
    return day +
        Math.ceil(29.5 * (month - 1)) +
        (year - 1) * 354 +
        Math.floor((3 + (11 * year)) / 30) + 1948439 - 1;
}

function toArabicDigits(str) {
    return str.toString().replace(/[0-9]/g, d => "٠١٢٣٤٥٦٧٨٩"[d]);
}
