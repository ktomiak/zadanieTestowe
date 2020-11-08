const SKILLS = [
    'bike',
    'driving license',
    { "type": 'car', "doors": 4 },
];

const JOBS = [
    {
        "name": "Company XXX",
        "requirements": [["bike", "XXX"], "driving license"]
    },
    {
        "name": "Company A",
        "requirements": [["apartment", "house"], "property insurance"]
    },
    {
        "name": "Company B",
        "requirements": [
            { "type": "car", "doors": [4, 5] },
            "driving license",
            "car insurance"
        ]
    },
    {
        "name": "Company C",
        "requirements": ["social security number", "work permit"]
    },
    {
        "name": "Company D",
        "requirements": [["apartment", "flat", "house"]]
    },
    {
        "name": "Company E",
        "requirements": [{ "type": "car", "doors": [2, 3, 4, 5] }, "driving license"]
    },
    {
        "name": "Company F",
        "requirements": [
            ["scooter", "bike", "motorcycle", "work permit"],
            " motorcycle insurance",
            "car insurance"
        ]
    },
    {
        "name": "Company G",
        "requirements": ["massage qualification certificate", "liability insurance"]
    },
    {
        "name": "Company H",
        "requirements": [["storage place", "garage"]]
    },
    {
        "name": "Company J",
        "requirements": []
    },
    {
        "name": "Company H",
        "requirements": [["PayPal account"]]
    }
];

const checkRequirement = (requirement, skills) => {
    if (typeof requirement === 'string') {
        return skills.includes(requirement);
    } else {
        let skill = skills.find(s => s.type === requirement.type);

        if (!skill) return false;

        let params = Object.keys(requirement).filter(param => param !== 'type');
        return params.every(param => requirement[param].includes(skill[param]));
    }
};

const searchJobs = (jobs, skills) => jobs.filter(item => {
    return item.requirements.every(requirement => {
        if (Array.isArray(requirement)) {
            return requirement.some(subRequirement => checkRequirement(subRequirement, skills));
        } else {
            return checkRequirement(requirement, skills);
        }
    });
}).map(job => job.name);

let results = searchJobs(JOBS, SKILLS);
console.log(results);