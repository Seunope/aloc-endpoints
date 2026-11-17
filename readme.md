<div align="center">

# ALOC — Assessment Content Infrastructure for African EdTech

[![ALOC Station v1](https://img.shields.io/badge/ALOC_Station_v1-Live_Platform-f59e0b?style=for-the-badge)](https://aloc.com.ng?utm_source=github_aloc_endpoints)
[![PyPI version](https://img.shields.io/pypi/v/aloc-sdk?style=for-the-badge&label=PyPI%20%7C%20aloc-sdk&color=10b981)](https://pypi.org/project/aloc-sdk/)
[![npm version](https://img.shields.io/npm/v/@massteck/aloc-sdk?style=for-the-badge&label=npm%20%7C%20%40massteck%2Faloc-sdk&color=cb3837)](https://www.npmjs.com/package/@massteck/aloc-sdk)
[![MCP Server](https://img.shields.io/npm/v/@massteck/aloc-mcp-server?style=for-the-badge&label=MCP%20%7C%20%40massteck%2Faloc-mcp-server&color=6366f1)](https://aloc.com.ng/docs/mcp?utm_source=github_aloc_endpoints)

**Verified WAEC, JAMB/UTME (1997–2026), NECO & Post-UTME Questions · L2 Topic & Difficulty Metadata · L3 Step-by-Step Explanations · L4 Vector Similarity**

[**🚀 Get Free API Key (1,000 Credits/mo)**](https://aloc.com.ng/register?utm_source=github_aloc_endpoints) · [**🎮 Live API Playground**](https://aloc.com.ng/playground?utm_source=github_aloc_endpoints) · [**📖 Documentation**](https://aloc.com.ng/docs/getting-started?utm_source=github_aloc_endpoints) · [**🔄 5-Minute Migration Guide**](https://aloc.com.ng/docs/migration?utm_source=github_aloc_endpoints)

</div>

---

> ### ⚠️ Legacy Repository Notice (`questions.aloc.com.ng` Sunset: August 1, 2027)
> **`Seunope/aloc-endpoints` (`questions.aloc.com.ng/api/v2`) is our legacy v0/v2 codebase and has been superseded by [ALOC Station (`aloc.com.ng`)](https://aloc.com.ng?utm_source=github_aloc_endpoints).**
>
> - **Building a new CBT platform, EdTech app, or AI tutor?** Start directly on **[ALOC Station v1](https://aloc.com.ng/register?utm_source=github_aloc_endpoints)** (new legacy v2 token registrations are closed).
> - **Already running on `questions.aloc.com.ng`?** Existing `AccessToken` integrations remain operational until **August 1, 2027**. Follow the **[5-Minute Migration Guide](https://aloc.com.ng/docs/migration?utm_source=github_aloc_endpoints)** to upgrade before sunset.

---

## Why Upgrade to ALOC Station (v1)?

Over **16.9 million+ API requests** later, we rebuilt ALOC from the ground up into production-grade assessment infrastructure for EdTech startups, schools, software agencies, and AI builders across Africa:

| Capability | Legacy `aloc-endpoints` (v2) | **ALOC Station (`aloc.com.ng` v1)** |
| :--- | :--- | :--- |
| **Base Endpoint** | `questions.aloc.com.ng/api/v2/q` *(Deprecated)* | **`dev.aloc.com.ng/api/v1`** |
| **Verified Dataset** | ~6,000 unverified items (frozen pre-2024) | **13,819+ SHA-256 deduplicated items (`1988–2026`, incl. 2025 & 2026 JAMB)** |
| **Filter Integrity** | Silently returns random fallback questions when a year/exam misses | **Strict `examType` & `year` isolation + actionable coverage hints** |
| **L2 Curriculum Metadata** | ❌ None | **✅ 100% mapped (`topic`, `subtopic`, `difficultyScore` 1–5, `curriculumAlignment`)** |
| **L3 Worked Explanations** | ❌ Sparse raw text | **✅ 95.5% coverage with step-by-step reasoning, simplified summaries & student pitfalls** |
| **L4 Vector Intelligence** | ❌ None | **✅ `pgvector` semantic similar-question retrieval & longitudinal syllabus trends** |
| **Assessment Engine** | ❌ Manual client-side state | **✅ Server-side balanced papers (`jamb_standard_40`, `waec_standard_50`), seeds & option shuffling** |
| **Official SDKs & AI Agents** | ❌ Raw HTTP / cURL only | **✅ Python (`aloc-sdk`), TypeScript (`@massteck/aloc-sdk`), & MCP Server (`@massteck/aloc-mcp-server`)** |
| **Pricing & Currencies** | Legacy static units | **1,000 Free credits/mo · NGN & USD plans · Non-expiring add-on packs from ₦2,000 ($2)** |

📊 **Inspect real-time subject & year counts anytime (0 credits):** [https://aloc.com.ng/coverage](https://aloc.com.ng/coverage?utm_source=github_aloc_endpoints)

---

## Quickstart on ALOC Station (v1)

Create a free developer account at **[aloc.com.ng/register](https://aloc.com.ng/register?utm_source=github_aloc_endpoints)** to grab your `aloc_live_...` API key (**1,000 free monthly credits**, no card required).

### 1. Python SDK (`pip install aloc-sdk`)

```bash
pip install aloc-sdk
```

```python
from aloc_sdk import AlocClient, GenerateAssessmentRequest

client = AlocClient(api_key="aloc_live_your_key_here")

# Fetch enriched 2026 JAMB Mathematics questions (L1 + L2 metadata)
res = client.questions.list_questions(
    subject="mathematics",
    exam_type="jamb",
    year=2026,
    limit=10,
)

for q in res.data:
    print(f"[{q.exam_type.upper()} {q.year}] {q.text}")
    print(f"Answer: {q.correct_answer} | Topic: {q.metadata.topic if q.metadata else None}")

# Assemble a syllabus-balanced 40-question UTME mock paper
paper = client.assessments.generate_assessment(
    generate_assessment_request=GenerateAssessmentRequest(
        subject="mathematics",
        examType="jamb",
        preset="jamb_standard_40",
        shuffleOptions=True,
    )
)
```

### 2. TypeScript / Node.js SDK (`npm install @massteck/aloc-sdk`)

```bash
npm install @massteck/aloc-sdk
```

```typescript
import { AssessmentsApi, Configuration, QuestionsApi } from "@massteck/aloc-sdk";

const config = new Configuration({
  apiKey: process.env.ALOC_API_KEY || "aloc_live_your_key_here",
});

const questionsApi = new QuestionsApi(config);
const { data } = await questionsApi.listQuestions({
  subject: "chemistry",
  examType: "jamb",
  year: 2026,
  limit: 10,
});
```

### 3. Direct REST API (`cURL`)

```bash
curl "https://dev.aloc.com.ng/api/v1/questions?subject=physics&examType=jamb&year=2026&limit=10" \
  -H "X-API-Key: aloc_live_your_key_here"
```

### 4. AI Coding Agents & Tutors (Claude Desktop, Cursor, Windsurf — MCP)

```bash
npx -y @massteck/aloc-mcp-server
```

Full MCP setup guide: **[aloc.com.ng/docs/mcp](https://aloc.com.ng/docs/mcp?utm_source=github_aloc_endpoints)**

---

## Official Links & Support

- 🌐 **Developer Portal**: [https://aloc.com.ng](https://aloc.com.ng?utm_source=github_aloc_endpoints)
- 📖 **API & SDK Documentation**: [https://aloc.com.ng/docs/sdks](https://aloc.com.ng/docs/sdks?utm_source=github_aloc_endpoints)
- 🎮 **Interactive API Playground**: [https://aloc.com.ng/playground](https://aloc.com.ng/playground?utm_source=github_aloc_endpoints)
- 📈 **Live Dataset Coverage & Quality Telemetry**: [https://aloc.com.ng/data-quality](https://aloc.com.ng/data-quality?utm_source=github_aloc_endpoints)
- 🔄 **Legacy v2 → v1 Migration Guide**: [https://aloc.com.ng/docs/migration](https://aloc.com.ng/docs/migration?utm_source=github_aloc_endpoints)
- 📧 **Engineering & Enterprise Licensing**: [aloc.mass@gmail.com](mailto:aloc.mass@gmail.com)

---

<details>
<summary><strong>📜 Archive: Legacy v2 Endpoint Reference & Self-Host Setup (Deprecated — Sunset August 1, 2027)</strong></summary>

<br>

> **Deprecation Warning:** The `/api/v2/*` endpoints below are frozen in maintenance mode and will shut down permanently on **August 1, 2027**. Do not use these endpoints for new projects — integrate **[ALOC Station v1](https://aloc.com.ng/docs/getting-started?utm_source=github_aloc_endpoints)** instead.

### Legacy v2 Endpoints (`questions.aloc.com.ng`)

- Single random question: `GET https://questions.aloc.com.ng/api/v2/q?subject=chemistry`
- Multiple questions: `GET https://questions.aloc.com.ng/api/v2/q/10?subject=chemistry&year=2010&type=utme`
- Batch questions: `GET https://questions.aloc.com.ng/api/v2/m?subject=chemistry`
- Question by legacy ID: `GET https://questions.aloc.com.ng/api/v2/q-by-id/1?subject=chemistry`
- Header required: `AccessToken: ALOC-...`

### Local Archive Setup

1. Run `composer install`
2. Copy `.env.example` to `.env` and configure `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
3. Run `php artisan key:generate`
4. Run `php artisan migrate`
5. Optional test seed: `php artisan db:seed --class=LoadDummyQuestions`
6. Start local server: `php artisan serve`

</details>

---

## License

This legacy archive repository is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). Modern ALOC Station v1 SDKs and API services are governed by the [ALOC Terms of Service](https://aloc.com.ng/terms).
