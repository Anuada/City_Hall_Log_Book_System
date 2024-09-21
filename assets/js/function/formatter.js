/**
 * The formatDate function converts a date string into a formatted date string in the format "Month Day, Year".
 * @param {*} dateStr The date string to be formatted.
 * @returns 
 */
export const formatDate = (dateStr) => {
    const date = new Date(dateStr);

    const options = { year: "numeric", month: "long", day: "numeric" };
    return date.toLocaleDateString("en-US", options);
};

/**
 * The **`ucWords`** function capitalizes the first letter of each word in a string and converts the rest of the letters to lowercase.
 * @param {*} str The input string to be transformed, with each word’s first letter capitalized and the rest in lowercase.
 * @returns 
 */
export const ucWords = (str) => {
    return str.split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
}

/**
 * The **`strReplace`** function replaces the first dash (-) in a string with a space ( ).
 * @param {*} str The input string with dashes (-) to be replaced by spaces.
 * @returns 
 */
export const strReplace = (str) => {
    return str.replace(/-/, ' ');
}

/**
 * The **`idFormatter`** function ensures that a given numeric string (ID) is formatted into groups of three digits, separated by dashes (-). 
 * @param {*} id A string of digits representing an ID.
 * @returns If the ID is already formatted correctly, it returns the original value. If not, it reformats the ID by inserting dashes at the appropriate places.
 */
export const idFormatter = (id) => {
    const idFormat = /^\d{3}(-\d{3})*$/;
    if (idFormat.test(id)) {
        return id;
    }
    const formattedID = id.replace(/(\d{3})(?=(\d{3})+(?!\d))/g, '$1-');
    return formattedID;
}